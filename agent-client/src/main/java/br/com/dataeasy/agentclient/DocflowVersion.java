package br.com.dataeasy.agentclient;

import org.w3c.dom.Document;
import org.w3c.dom.NodeList;
import org.xml.sax.SAXException;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import java.io.File;
import java.io.FileInputStream;

import java.io.IOException;

public class DocflowVersion {

    public static String getStandaloneConfigPath() {

        String jbossPath = JbossConfig.getJbossPath();
        String stlPath = jbossPath.concat("/standalone/configuration");
        String stlConfigPath = stlPath.concat("/standalone.xml");
        return stlConfigPath;

    }

    public static String getDocflowVersion() {

        String stlConfig = getStandaloneConfigPath();
        String dcfVersion = null;

        try {
            File fileConfig = new File(stlConfig);
            FileInputStream fis = new FileInputStream(fileConfig);

            DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
            DocumentBuilder db = dbf.newDocumentBuilder();
            Document doc = db.parse(stlConfig);
            NodeList nodeList = doc.getElementsByTagName("deployment");

            for (int x = 0, size = nodeList.getLength(); x < size; x++) {
                if (nodeList.item(x).getAttributes().getNamedItem("name").getNodeValue().startsWith("docflow")) {
                    dcfVersion = nodeList.item(x).getAttributes().getNamedItem("name").getNodeValue();
                    dcfVersion = dcfVersion.split("-")[2].replace(".war", "");
                }
            }
        } catch (Exception e){
            e.printStackTrace();
        }

        return dcfVersion;
    }
}
