#### Gerar agent-client.jar

##### Configurar Intellij

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
          
##### Gerar

        Build Build Artifacts
        Build

##### Após gerar .jar

        Abrir o agent-client.jar em algum software de compactação e editar o arquivo MANIFEST.MF
        Adicionar a seguinte no arquivo:
            Main-Class: br.com.dataeasy.agentclient.ConfigProperties

        OBS.: Adicionar após a primeira linha:

        Manifest-Version: 1.0
        Main-Class: br.com.dataeasy.agentclient.ConfigProperties
        ...

#### Instalação do Agent

    Criar a pasta /opt/sistemas/dataeasy/shield

##### Download Agent of Shield

	curl -u well:well -O -# https://download.dataeasy.com.br/well/instaladores/shield/agent/agent-client.jar

##### Shield

	vim /opt/sistemas/dataeasy/shield/agent-shield

	#!/bin/bash
	/opt/java/bin/java -jar /opt/sistemas/dataeasy/shield/agent-client.jar CLIENT CNPJ ENVIRONMENT
	
	CLIENT - Sigla do cliente (PGE-SP, ABDI, CNSESI, ...)
	CNPJ - CNPJ é chave para o sistema
	ENVIRONMENT - Tipo de Ambiente: PRODUCTION | HOMOLOGATION | TRAINING | DEMO

##### Crontab

	JBOSS_HOME=/opt/jboss
    
    	# Agent of Shield
    	0 0 * * * /opt/sistemas/dataeasy/shield/agent-shield
