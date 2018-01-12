package br.com.dataeasy.agentclient;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import java.io.*;
import java.nio.charset.Charset;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.*;


public class ConfigProperties {

    private static final String URL = "http://shield.dataeasy.com.br/api/readJSON";

    public static void main(String[] args) throws IOException {

        if (args.length != 3) {
            System.err.println("ARGS is not valid!!!");
            System.out.println("Usage: ");
            System.out.println("\t java -jar AgentClient.jar CLIENT CNPJ ENVIRONMENT");
            System.out.println("\t ENVIRONMENT: PRODUCTION | HOMOLOGATION | TRAINING | DEMO");
            // Se não vier com algum parametro, sai
            System.exit(0);
        }

        // Dados do Cliente
        //String client = "dataeasy";
        String client = args[0];
        //String cnpj = "06052373000192";
        String cnpj = args[1];
        // String env = "PRODUÇÃO"
        String env = args[2];
        String dcfVersion = DocflowVersion.getDocflowVersion();


        String dataeasyConfigPath = null;

        //Get SO
        String osName = OperationalSystem.getOSName();

        //JsonFile
        String jsonFile = "config." + client + ".config.json";

        if ( osName == "Linux") {
            String pathJsonFile = "/tmp";
            jsonFile = pathJsonFile + "/" + jsonFile;
        }

        Writer jsonWriter = new OutputStreamWriter(new FileOutputStream(jsonFile) , "UTF-8");

        //Get JBOSS_HOME
        String jbossConfig = JbossConfig.getJbossPath();

        // Get JBoss Config (Standalone.conf)
        String jbossConfigPath = JbossConfig.getJbossConfig(osName);

        // Get VAR: Windows(%JBOSS_HOME%) or Linux ($JBOSS_HOME)
        String varJBoss = JbossConfig.getVarJboss(osName);

        try{
            List<String> lines = Files.readAllLines(Paths.get(jbossConfigPath), Charset.forName("UTF-8"));

            for (String line : lines) {

                if (line.contains("dataeasy.config.path")){
                    dataeasyConfigPath = line.split("=")[2].replace("\"","");
                    dataeasyConfigPath = dataeasyConfigPath.replace(varJBoss, jbossConfig);
                    dataeasyConfigPath = dataeasyConfigPath.concat("/docflow/");
                    break;
                }
            }

            String docflowConfigProperties = dataeasyConfigPath.concat("config.properties");
            GsonBuilder builder = new GsonBuilder();
            Gson gson = builder.setPrettyPrinting().create();

            List<String> linesconfig = Files.readAllLines(Paths.get(docflowConfigProperties), Charset.forName("UTF-8"));
            LinkedHashMap<String, String> map = new LinkedHashMap<>();

            map.put("docflow.client", client);
            map.put("docflow.client.cnpj", cnpj);
            map.put("docflow.client.environment", env);
            map.put("docflow.versao.sistema", dcfVersion);

            for (String lineconfig : linesconfig) {

                if (!lineconfig.startsWith("#") & !lineconfig.isEmpty()){
                    String[] docflowConfig = lineconfig.split("=");
                    map.put(docflowConfig[0], docflowConfig.length > 1 ? docflowConfig[1] : "");
                }
            }

            gson.toJsonTree(map);
            gson.toJson(map,jsonWriter);
            String json = gson.toJson(map);

            // Save JSON
            jsonWriter.close();

            HttpUtil.postJson(json, URL);

        } catch (Exception e){
            e.printStackTrace();
        }

    }

}
