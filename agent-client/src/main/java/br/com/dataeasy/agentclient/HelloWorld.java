package br.com.dataeasy.agentclient;

import java.util.Properties;

public class HelloWorld {

    public static void main (String[] args){

        System.out.println("Heel World!");
        System.out.println(System.getenv("JBOSS_HOME"));
        Properties properties = System.getProperties();
        String os_name = System.getProperty("os.name");
        System.out.println("OS.NAME: " + os_name);
        os_name = os_name.split(" ")[0];
        System.out.println("SPLIT: " + os_name);
    }

}
