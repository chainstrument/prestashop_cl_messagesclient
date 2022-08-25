{extends file='customer/page.tpl'}


{block name="page_title"}
  {l s='New message' d='Modules.cl_messagesclient.Shop'}
{/block}

{block name="page_content"}
    
<section class="login-form">
 
  <form action="" method="post"  >
    <div class="form-group">
    <label>
        {l s='List of users' d='Modules.cl_messagesclient.Shop'} 
     </label>    
        <select name="id_customer">
        {foreach from=$users item=user}
            <option value="{$user.id_customer|escape:'htmlall':'UTF-8'}">{$user.name}</option>
        {/foreach}
        </select>
    </div>

<div class="form-group">
       <label> {l s='Subject' d='Modules.cl_messagesclient.Shop'}  </label>
          <input type="text" name="subject" value="" />
       
    </div>
    <div class="form-group">
  <label> {l s='Message' d='Modules.cl_messagesclient.Shop'} </label>
        <textarea cols="67" rows="3" name="message"> </textarea>
    </div>
 <button type="submit" name="submitMessage">
          {l s='Send' d='Modules.cl_messagesclient.Shop'}
        </button>
        </form>
</section>

{/block}