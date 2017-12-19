#!/usr/bin/env bash

### VARIABLES ###
############################################################################################################################################################################
# Client Docflow
CLIENT="dataeasy"

# CLIENT CNPJ
CLIENT_CNPJ="06052373000192"

# Enviroment Client - (PRODUÇÃO / HOMOLOGAÇÃO / TREINAMENTO / SUPORTE)
CLIENT_ENVIRONMENT="PRODUÇÃO"

# standalone / domain
CLIENT_TYPE=standalone

# Jboss Home - DEFAULT
JBOSS_HOME=/opt/jboss

# DataEasy Config Path
CONFIGPATH=`cat ${JBOSS_HOME}/bin/standalone.conf | grep dataeasy.config.path | awk -F= '{print $3 }' | awk -F '"' '{print $1}'`

# Docflow Version Instaled
DOCFLOW_VERSION=`cat ${JBOSS_HOME}/${CLIENT_TYPE}/configuration/standalone.xml | grep docflow4-web | awk -F '"' '{print $2}'| awk -F '-' '{print $3}' | sed -e s/.war//g`

# Docflow Config Properties
CONFIGPATHCONFIG="${CONFIGPATH}/docflow/config.properties"

# Config Properties without Comments
CONFIG=`grep -o '^[^#]*' ${CONFIGPATHCONFIG}`

# Json File with name Client
JSON_FILE=docflow.${CLIENT}.json
############################################################################################################################################################################

echo "{" > ${JSON_FILE}
echo "      \"docflow.client\": \"${CLIENT}\"," >> ${JSON_FILE}
echo "      \"docflow.client.cnpj\": \"${CLIENT_CNPJ}\"," >> ${JSON_FILE}
echo "      \"docflow.client.enviroment\": \"${CLIENT_ENVIRONMENT}\"," >> ${JSON_FILE}
echo "      \"docflow.versao.sistema\": \"${DOCFLOW_VERSION}\"," >> ${JSON_FILE}

while read linha
do
    CARACTER=`echo $linha | sed 's/\(^.\).*/\1/'`

    if [ "$CARACTER" != "#" ]; then
        if [ -n "$CARACTER" ]; then
            LINHA=`echo $linha | awk '{print "      \"" $1 "\": \"" $3 "\","}'`
            echo "$LINHA" >> ${JSON_FILE}
        fi
    fi

done < ${CONFIGPATHCONFIG}

# Remove a vírgula da última linha
AUX=`echo "$LINHA" | sed 's/,//g'`

# Substitui a ultima linha pela linha sem vírgula
sed -i "s|$LINHA|$AUX|g" ${JSON_FILE}

echo "}">> ${JSON_FILE}

md5sum ${JSON_FILE} > MD5File

# Validade JSON: http://www.jsontest.com/

