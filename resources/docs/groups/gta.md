# GTA


## Dados das GTAs

<small class="badge badge-darkred">requires authentication</small>

<aside class="notice">Retorna o conjunto de GTAs emitidas.</aside>

> Example request:

```bash
curl -X GET \
    -G "http://gtaapi.macsolucoes.com/gta?ano=19&mes=neque&finalidade=molestiae&especie=debitis&registrosPagina=10&pagina=19" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://gtaapi.macsolucoes.com/gta"
);

let params = {
    "ano": "19",
    "mes": "neque",
    "finalidade": "molestiae",
    "especie": "debitis",
    "registrosPagina": "10",
    "pagina": "19",
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
    "numGTA": "604708",
    "serieGTA": "D",
    "dataHoraEmissao": "2019-01-02",
    "ano": "2019",
    "mes": "1",
    "tipoDeTransporte": "RODOVIÁRIO",
    "finalidade": "Abate",
    "especie": "BOVINOS",
    "orig_Id": "16621",
    "dest_Id": "10399",
    "orig_Tipo": "Propriedade",
    "dest_Tipo": "Agroindustria",
    "bovTotal": "6",
    "bovMacho": "6",
    "bovFemea": "0",
    "bov0a12Macho": "0",
    "bov0a12Femea": "0",
    "bov13a24Macho": "0",
    "bov13a24Femea": "0",
    "bov25a36Macho": "0",
    "bov25a36Femea": "0",
    "bovmais36Macho": "6",
    "bovmais36Femea": "0"
}
```
<div id="execution-results-GETgta" hidden>
    <blockquote>Received response<span id="execution-response-status-GETgta"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETgta"></code></pre>
</div>
<div id="execution-error-GETgta" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETgta"></code></pre>
</div>
<form id="form-GETgta" data-method="GET" data-path="gta" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETgta', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETgta" onclick="tryItOut('GETgta');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETgta" onclick="cancelTryOut('GETgta');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETgta" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>gta</code></b>
</p>
<p>
<label id="auth-GETgta" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETgta" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>ano</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="ano" data-endpoint="GETgta" data-component="query" required  hidden>
<br>
<b>Ano de emissão das GTAs</b></p>
<p>
<b><code>mes</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="mes" data-endpoint="GETgta" data-component="query"  hidden>
<br>
Mes de emissão das GTAs</p>
<p>
<b><code>finalidade</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="finalidade" data-endpoint="GETgta" data-component="query"  hidden>
<br>
Nome do Estado</p>
<p>
<b><code>especie</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="especie" data-endpoint="GETgta" data-component="query"  hidden>
<br>
Nome do Estado</p>
<p>
<b><code>registrosPagina</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="registrosPagina" data-endpoint="GETgta" data-component="query"  hidden>
<br>
Numero de registros em cada página da lista</p>
<p>
<b><code>pagina</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="pagina" data-endpoint="GETgta" data-component="query"  hidden>
<br>
Pagina da lista a ser apresentada</p>
</form>

### Response
<h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
<p>
<b><code>numGTA</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>serieGTA</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
.</p>
<p>
<b><code>dataHoraEmissao</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
date .</p>
<p>
<b><code>ano</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>mes</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>tipoDeTransporte</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
.</p>
<p>
<b><code>finalidade</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
.</p>
<p>
<b><code>especie</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
.</p>
<p>
<b><code>orig_Id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>dest_Id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>orig_Tipo</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
.</p>
<p>
<b><code>dest_Tipo</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
.</p>
<p>
<b><code>bovTotal</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>bovMacho</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>bovFemea</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>bov0a12Macho</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>bov0a12Femea</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>bov13a24Macho</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>bov13a24Femea</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>bov25a36Macho</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>bov25a36Femea</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>bovmais36Macho</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>
<p>
<b><code>bovmais36Femea</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
.</p>


