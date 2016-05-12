<?php require_once 'common/header.php'?>
<?php require_once 'common/sidebar.php'?>
<!-- start: Content -->
<div id="content" class="span10">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Dashboard</a></li>
    </ul>




<form class="form-horizontal">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="typeahead">Auto complete </label>
            <div class="controls">
                <input type="text" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                <p class="help-block">Start typing to activate auto complete!</p>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="reset" class="btn">Cancel</button>
        </div>
    </fieldset>
</form>


</div><!--/.fluid-container-->

<?php require_once 'common/footer.php'?>