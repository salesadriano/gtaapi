# Estabelecimento


## Dados dos Estabelecimento

<small class="badge badge-darkred">requires authentication</small>

<aside class="notice">Retorna o conjunto de dados dos estabelecimento e as GTAs emitidas em favor deles.</aside>

> Example request:

```bash
curl -X GET \
    -G "http://gtaapi.macsolucoes.com/estabelecimento?municipio=et&ano=19&UF=cum&nomUF=quam&completo=1&registrosPagina=17&pagina=1" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://gtaapi.macsolucoes.com/estabelecimento"
);

let params = {
    "municipio": "et",
    "ano": "19",
    "UF": "cum",
    "nomUF": "quam",
    "completo": "1",
    "registrosPagina": "17",
    "pagina": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json

{
'id':0,
'codUF': 12,
'UF': 'AC',
'nomUF': 'Acre',
'codMunicipio': 120212,
'municipio': 'Rio Branco',
'latitude': 1.23123,
'longitude': 1.123123,
'tipoDeEstabelecimento': 'Fazenda',
'GTAs': ['GTAs'],
'ano': 2020}
```
<div id="execution-results-GETestabelecimento" hidden>
    <blockquote>Received response<span id="execution-response-status-GETestabelecimento"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETestabelecimento"></code></pre>
</div>
<div id="execution-error-GETestabelecimento" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETestabelecimento"></code></pre>
</div>
<form id="form-GETestabelecimento" data-method="GET" data-path="estabelecimento" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETestabelecimento', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETestabelecimento" onclick="tryItOut('GETestabelecimento');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETestabelecimento" onclick="cancelTryOut('GETestabelecimento');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETestabelecimento" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>estabelecimento</code></b>
</p>
<p>
<label id="auth-GETestabelecimento" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETestabelecimento" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>municipio</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="municipio" data-endpoint="GETestabelecimento" data-component="query" required  hidden>
<br>
<b>Nome do Municipio</b></p>
<p>
<b><code>ano</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="ano" data-endpoint="GETestabelecimento" data-component="query" required  hidden>
<br>
<b>Ano de emissão das GTAs</b></p>
<p>
<b><code>UF</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="UF" data-endpoint="GETestabelecimento" data-component="query"  hidden>
<br>
Sigla do Estado</p>
<p>
<b><code>nomUF</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="nomUF" data-endpoint="GETestabelecimento" data-component="query"  hidden>
<br>
Nome do Estado</p>
<p>
<b><code>completo</code></b>&nbsp;&nbsp;<small>boolean</small>     <i>optional</i> &nbsp;
<label data-endpoint="GETestabelecimento" hidden><input type="radio" name="completo" value="1" data-endpoint="GETestabelecimento" data-component="query" ><code>true</code></label>
<label data-endpoint="GETestabelecimento" hidden><input type="radio" name="completo" value="0" data-endpoint="GETestabelecimento" data-component="query" ><code>false</code></label>
<br>
Determina se as GTAs serão retornadas</p>
<p>
<b><code>registrosPagina</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="registrosPagina" data-endpoint="GETestabelecimento" data-component="query"  hidden>
<br>
Numero de registros em cada página da lista</p>
<p>
<b><code>pagina</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="pagina" data-endpoint="GETestabelecimento" data-component="query"  hidden>
<br>
Pagina da lista a ser apresentada</p>
</form>

### Response
<h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
ID do registro no bando de dados</p>
<p>
<b><code>codUF</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
Codigo do municipio no IBGE</p>
<p>
<b><code>UF</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
Sigla do Estado</p>
<p>
<b><code>nomUF</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
Nome do Estado</p>
<p>
<b><code>codMunicipio</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
Codigo do municipio no IBGE</p>
<p>
<b><code>municipio</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
Nome do municipio</p>
<p>
<b><code>latitude</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
<br>
Latitude do estabelecimento</p>
<p>
<b><code>longitude</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
<br>
Longitude do estabelecimento</p>
<p>
<b><code>tipoDeEstabelecimento</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
Tipo de Estabelecimento</p>
<p>
<b><code>GTAs</code></b>&nbsp;&nbsp;  &nbsp;
<br>
GTA[] GTAs associadas ao Estabelecimento</p>
<p>
<b><code>ano</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
Ano de emissão das GTAs</p>


