package br.com.dataeasy.agentclient;

import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.BasicResponseHandler;
import org.apache.http.impl.client.CloseableHttpClient;
import org.apache.http.impl.client.HttpClientBuilder;

import java.io.FileReader;

public class HttpUtil {

    public static String postJson(String json, String url ) throws Exception{

        String statsServer = null;
        //String json = "/home/wellington.jorge/git/github/dataeasy/configs/shell-scripts/agent/agent-client/config.DataEasy.config.json";
        //String url = "http://192.168.200.10:8000/api/readJSON";

        try (CloseableHttpClient httpClient = HttpClientBuilder.create().build()) {

            HttpPost request = new HttpPost(url);
            request.addHeader("content-type", "application/json");
            request.setEntity(new StringEntity(json));
            statsServer = httpClient.execute(request,new BasicResponseHandler());
            System.out.println(statsServer);

        } catch ( Exception e){
            e.printStackTrace();
        }

        return statsServer;
    }
}
