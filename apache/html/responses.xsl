<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xs="http://www.w3.org/2001/XMLSchema" exclude-result-prefixes="xs" version="2.0">
  <xsl:template match="/">
    <html xmlns="http://www.w3.org/1999/xhtml">
      <style>
              .changing{
                padding:5px;
                background-color:#555;
                color:black;
                display:inline-block;
                width:200px;
              }
            </style>
      <body>
        <h2>Advice received from people about each emotion</h2>
        <table border="1">
          <tr bgcolor="#329ACD">
            <th>Emotion</th>
            <th>Advice</th>
            <th>Severity level</th>
          </tr>
          <xsl:for-each select="emotions/emotion">
            <tr>
              <td class="depending">
                <xsl:value-of select="emotion_name" />
              </td>
              <td bgcolor="#9acd32">
                <xsl:value-of select="response" />
              </td>
              <td class="changing">
                <xsl:value-of select="severity_level" />
              </td>
            </tr>
          </xsl:for-each>
        </table>

        <script>
          function changeColor(element) {
                    const content = element.textContent;
                    
                    if(content=="malicious_significant_impact"){
                      element.style.backgroundColor = 'red';
                    }
                    if(content=="bad_significant_impact"){
                      element.style.backgroundColor = 'yellow';
                    }
                    if(content=="good_high_impact"){
                      element.style.backgroundColor = 'pink';
                    }
                  }
                  const elements = document.querySelectorAll('.changing');
                  elements.forEach(changeColor); 


                  function setColor(element) {
                    //
          <![CDATA[
                    const list = document.querySelectorAll('.changing');
                    for (var i=0; i < list.length; i++){
                      const contentleftside = list[i].textContent;                     
                      if(contentleftside=="malicious_significant_impact"){
                        element.style.backgroundColor = 'red';
                      }
                      if(contentleftside=="bad_significant_impact"){
                        element.style.backgroundColor = 'yellow';
                      }
                      if(contentleftside=="good_high_impact"){
                        element.style.backgroundColor = 'pink';
                      }                    
                    }
                    console.log(element)
                    //]]>
          }
                  const rightelements = document.querySelectorAll('.depending');
                  rightelements.forEach(setColor);
        </script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>