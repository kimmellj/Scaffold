<div class="box">
    <div class="title">
        <h5>Admin Edit Content Page</h5>
        <ul class="links">
            <li><?php echo $this->Html->link('Back', $historyLastPage); ?></li>
        </ul>
    </div>
    <?php echo $this->Session->flash(); ?>    
    <?php echo $this->Form->create('ContentPage', array('inputDefaults' => Configure::read('Settings.Themes.SmoothAdmin.inputDefaults')));?>
        <div class="form">
            <div class="fields">
                <?php
                echo $this->Form->input('ContentPage.id');
                echo $this->Form->input('ContentPage.name');
                echo $this->Form->input('ContentPage.title');
                echo $this->Form->input('ContentPage.slug');
                echo $this->Form->input('ContentPage.content');
                echo $this->Form->input('ContentPage.meta_keywords');
                echo $this->Form->input('ContentPage.meta_description');
                echo $this->Form->input('ContentPage.active', array('options'=>array('no','yes')));
                echo $this->Form->input('ContentPage.parent_id');
                echo $this->Form->input('ContentPage.lft');
                echo $this->Form->input('ContentPage.rght');
                echo $this->Form->input('ContentPage.sort');
                ?>
                <div class="buttons">
                    <div class="highlight">
                        <?php echo $this->Form->submit('Submit'); ?>                    </div>
                </div>
            </div>
        </div>
    <?php echo $this->Form->end(); ?>
</div>
