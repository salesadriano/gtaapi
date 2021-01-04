# Endpoints


## /




> Example request:

```bash
curl -X GET \
    -G "http://gtaapi.macsolucoes.com/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://gtaapi.macsolucoes.com/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (302):

```json

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://gtaapi.macsolucoes.com/docs'" />

        <title>Redirecting to http://gtaapi.macsolucoes.com/docs</title>
    </head>
    <body>
        Redirecting to <a href="http://gtaapi.macsolucoes.com/docs">http://gtaapi.macsolucoes.com/docs</a>.
    </body>
</html>
```
<div id="execution-results-GET-" hidden>
    <blockquote>Received response<span id="execution-response-status-GET-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GET-"></code></pre>
</div>
<div id="execution-error-GET-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GET-"></code></pre>
</div>
<form id="form-GET-" data-method="GET" data-path="/" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GET-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GET-" onclick="tryItOut('GET-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GET-" onclick="cancelTryOut('GET-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GET-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>/</code></b>
</p>
</form>


## Authenticate a user and return the token if the provided credentials are correct.




> Example request:

```bash
curl -X POST \
    "http://gtaapi.macsolucoes.com/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://gtaapi.macsolucoes.com/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


<div id="execution-results-POSTlogin" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTlogin"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTlogin"></code></pre>
</div>
<div id="execution-error-POSTlogin" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTlogin"></code></pre>
</div>
<form id="form-POSTlogin" data-method="POST" data-path="login" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTlogin', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTlogin" onclick="tryItOut('POSTlogin');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTlogin" onclick="cancelTryOut('POSTlogin');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTlogin" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>login</code></b>
</p>
</form>


## Retorna lista de registros cadastrados




> Example request:

```bash
curl -X GET \
    -G "http://gtaapi.macsolucoes.com/entidade" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://gtaapi.macsolucoes.com/entidade"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (401):

```json
{
    "error": "Token nao fornecido."
}
```
<div id="execution-results-GETentidade" hidden>
    <blockquote>Received response<span id="execution-response-status-GETentidade"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETentidade"></code></pre>
</div>
<div id="execution-error-GETentidade" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETentidade"></code></pre>
</div>
<form id="form-GETentidade" data-method="GET" data-path="entidade" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETentidade', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETentidade" onclick="tryItOut('GETentidade');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETentidade" onclick="cancelTryOut('GETentidade');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETentidade" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>entidade</code></b>
</p>
</form>


## Retorna lista de registros cadastrados




> Example request:

```bash
curl -X GET \
    -G "http://gtaapi.macsolucoes.com/estabelecimento" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://gtaapi.macsolucoes.com/estabelecimento"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (401):

```json
{
    "error": "Token nao fornecido."
}
```
<div id="execution-results-GETestabelecimento" hidden>
    <blockquote>Received response<span id="execution-response-status-GETestabelecimento"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETestabelecimento"></code></pre>
</div>
<div id="execution-error-GETestabelecimento" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETestabelecimento"></code></pre>
</div>
<form id="form-GETestabelecimento" data-method="GET" data-path="estabelecimento" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETestabelecimento', this);">
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
</form>


## Retorna lista de registros cadastrados




> Example request:

```bash
curl -X GET \
    -G "http://gtaapi.macsolucoes.com/gta" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://gtaapi.macsolucoes.com/gta"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (401):

```json
{
    "error": "Token nao fornecido."
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
<form id="form-GETgta" data-method="GET" data-path="gta" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETgta', this);">
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
</form>



