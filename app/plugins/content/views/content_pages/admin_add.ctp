<style type="text/css">
    #ContentPageAddButtons div.highlight{
        float:left;
        padding-right:15px;
    }
</style>
<?php echo $this->Form->create('ContentPage', array('id' => 'ContentPageAddForm', 'url' => array('parent' => !empty($parent_id) ? $parent_id : null), 'inputDefaults' => Configure::read('Settings.Themes.SmoothAdmin.inputDefaults')));?>
<div class="box">
    <div class="title">
        <h5>Add Content Page</h5>
        <ul class="links">
            <li><?php echo $this->Html->link('Back', $historyLastPage); ?></li>
        </ul>
    </div>
    <?php echo $this->Session->flash(); ?>
    <div class="form">
        <div class="fields">
            <?php
            echo $this->Form->input('ContentPage.id');
            echo $this->Form->input('ContentPage.name', array('title' => 'This is the name of the page.'));
            echo $this->Form->input('ContentPage.slug', array('label' => 'Pretty URL (Unique)', 'title' => 'This is the name of the page as seen in the address bar of a web browser. If this field is left empty one will be generated for you.'));
            echo $this->Form->input('ContentPage.active', array('options'=>array('no','yes'), 'title' => 'If you want this page to be visiable it must active to "yes".'));
            echo $this->Form->input('ContentPage.content');
            echo $this->Ckeditor->replace('ContentPage.content');
            echo $this->Form->hidden('ContentPage.parent_id', array('value' => !empty($parent_id) ? $parent_id : null));
            ?>
            <div class="title">
                <h5>SEO - Search Engine Optimization</h5>
            </div>
            <?php
            echo $this->Form->input('ContentPage.title', array('title' => 'This the is title of the page. The title will be used as the web browser\'s title.'));
            echo $this->Form->input('ContentPage.meta_keywords', array('title' => 'Enter keywords for this page to help with relevence searches for search engines like Google.'));
            echo $this->Form->input('ContentPage.meta_description', array('title' => 'Enter a page description to help with relevence searches for search engines like Google.'));
            ?>
            <div id="ContentPageAddButtons" class="buttons">
                <div class="highlight">
                    <?php echo $this->Form->submit('Submit'); ?>
                </div>
                <div class="highlight">
                    <?php echo $this->Form->submit('Preview', array('id' => 'ContentPagePreviewButton')); ?>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->hidden('ContentPage.preview', array('value' => 0));?>
<?php echo $this->Form->end(); ?>
<?php echo $this->Display->loadIt('Colorbox', array('style' => 'example5'));?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#ContentPagePreviewButton").bind('click', function(){
            $('#ContentPagePreview').val(1);
        });
        <?php if(!empty($this->data['ContentPage']['preview'])):?>
            $.colorbox({
                open:true,
                iframe:true,
                height:'90%',
                width:'90%',
                title:'Preview: <?php echo $this->data['ContentPage']['title'];?> - <i>The page has <u>NOT</u> yet been saved please remember to click submit after you are finish previewing. Click the the X to the right to exit preview mode.</i>',
                href:'<?php echo $this->Html->url(array('admin' => false, 'controller' => 'content_pages', 'action' => 'preview'), true);?>'
            });
            $('#ContentPagePreview').val(0);
        <?php endif;?>
    });
</script>
