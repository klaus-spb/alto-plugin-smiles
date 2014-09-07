<div class="form-group checkbox">
    <div class="input-group">
        <label for="disable_smiles">
            <input class="mal0" type="checkbox" id="disable_smiles" name="disable_smiles" value="1"
                   {if !empty($_aRequest.disable_smiles)}checked{/if} />
            {$aLang.plugin.smiles.disable_smiles}
        </label>
    </div>
</div>
<br/>