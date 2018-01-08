### Gerar agent-client.jar

    #### Configurar Intellij

        File
          Project Structure
          Artifacts
          +
          Jar
          From modules with dependencies
          Selected Main Class after browsing
          selected extract to the target jar
          Directory for META-INF automatically gets populated
          OK
          Apply
          OK 
          
    #### Gerar

        Build Build Artifacts
        Build

    #### Após gerar .jar

        Abrir o agent-client.jar em algum software de compactação e editar o arquivo MANIFEST.MF
        Adicionar a seguinte no arquivo:
            Main-Class: br.com.dataeasy.agentclient.ConfigProperties

        OBS.: Adicionar após a primeira linha:

        Manifest-Version: 1.0
        Main-Class: br.com.dataeasy.agentclient.ConfigProperties
        ...