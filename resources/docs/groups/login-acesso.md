# Login Acesso


## Login no Sistema


<aside class="notice">Autentica usuario na API.</aside>

> Example request:

```bash
curl -X POST \
    "http://gtaapi.macsolucoes.com/login?loginUsuarioSistema=ipsam&senhaUsuarioSistema=sunt" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://gtaapi.macsolucoes.com/login"
);

let params = {
    "loginUsuarioSistema": "ipsam",
    "senhaUsuarioSistema": "sunt",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json

{
"idUsuarioSistema": 1,
"idPessoa": null,
"nomeUsuarioSistema": "Usuario",
"emailUsuarioSistema": "usuario@email.com",
"situacaoUsuarioSistema": "ATIVO",
"remember_token": null,
"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.* eyJpc3MiOiJodHRwOlwvXC9ndGFhcGkubWFjc29sdWNvZXMuY29tIiwic3ViIjoxLCJ1c2VyIjoiQWRyaWFubyBTYWxlcyBTYW50b3MiLCJpYXQiOjE2MTAxMzU3NDEsImV4cCI6MTYxMDEzOTM0MX0.* 2gHZwAHqY5CHKENYVR_WU0Zk8LndeQ0LUkcFf7pKhMo"
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
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>loginUsuarioSistema</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="loginUsuarioSistema" data-endpoint="POSTlogin" data-component="query" required  hidden>
<br>
<b>Login do usuario</b></p>
<p>
<b><code>senhaUsuarioSistema</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="senhaUsuarioSistema" data-endpoint="POSTlogin" data-component="query" required  hidden>
<br>
<b>Senha do usuario</b></p>
</form>

### Response
<h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
<p>
<b><code>idUsuarioSistema</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
ID do registro no bando de dados</p>
<p>
<b><code>idPessoa</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
ID da pessoa assiciado ao usuario</p>
<p>
<b><code>nomeUsuarioSistema</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
Nome completo do usuario</p>
<p>
<b><code>emailUsuarioSistema</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
E-mail do usuario</p>
<p>
<b><code>situacaoUsuarioSistema</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
Situacao do usuario</p>
<p>
<b><code>token</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
Token de autorização do usuario</p>


