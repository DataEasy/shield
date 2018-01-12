package br.com.dataeasy.agentclient;

public class JbossConfig {

    public static String getJbossPath(){

        // Verifica no SO a variável de ambiente JBOSS_HOME
        String jbossPath = System.getenv("JBOSS_HOME");
        return jbossPath;
    }

    public static String getJbossConfig(String osName){

        String jbossPath = getJbossPath();
        String jbossConfig = jbossPath + "/bin/standalone.conf";

        if ( osName.equals("Windows")){
            jbossConfig = jbossConfig.concat(".bat");
        }

        return  jbossConfig;

    }

    public static String getVarJboss(String osName){

        // Return of VARIABLE depending OS
        if ( osName.equalsIgnoreCase("Windows")){
            return "%JBOSS_HOME%";
        }
        return "$JBOSS_HOME";
    }
}
