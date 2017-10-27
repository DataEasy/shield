package br.com.dataeasy.agentclient;

import java.util.Properties;

public class OperationalSystem {

    public static String getOSName(){

        Properties properties = System.getProperties();
        String osName = System.getProperty("os.name");
        osName = osName.split(" ")[0];
        return osName;
    }
}
