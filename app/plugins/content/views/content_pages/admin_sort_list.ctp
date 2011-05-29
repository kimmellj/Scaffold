<?php $this->Paginator->options(array('url' => $this->passedArgs)); ?><div class="box">
    <div class="title">
        <h5>Content Pages</h5>
        <ul class="links">
            <li><?php echo $this->Html->link('Add Content Page', array('action'=>'add'), array('class' => 'button sidebutton', 'escape' => false));?></li>
        </ul>
    </div>
    <?php echo $this->Session->flash(); ?>
    <?php if (empty($contentPages)): ?>
        <?php echo $this->FlashIt->notice('There are no content pages to display'); ?>
    <?php else: ?>
    <div class="table">
        <table id="tableDnD" cellpadding="0" cellspacing="0">
            <tr class="nodrag nodrop">
                <th><?php echo $this->Paginator->sort('name');?></th>
                <th><?php echo $this->Paginator->sort('slug');?></th>
                <th><?php echo $this->Paginator->sort('active');?></th>
                <th><?php echo $this->Paginator->sort('created');?></th>
                <th><?php echo $this->Paginator->sort('modified');?></th>
                <th class="actions last">Actions</th>
            </tr>
            <?php $i = 1;?>
            <?php foreach ($contentPages as $contentPage): ?>
                <tr id="<?php echo $i++;?>">
                    <td><?php echo $contentPage['ContentPage']['name']; ?></td>
                    <td><?php echo $contentPage['ContentPage']['slug']; ?></td>
                    <td><?php echo $contentPage['ContentPage']['active']; ?></td>
                    <td><?php echo $contentPage['ContentPage']['created']; ?></td>
                    <td><?php echo $contentPage['ContentPage']['modified']; ?></td>
                    <td class="actions last"> 
                        <?php echo $this->Display->iconLink('pencil.png', array('action'=>'edit', $contentPage['ContentPage']['id']), array('class' => 'tiptip', 'title' => 'Edit -> '.$contentPage['ContentPage']['id'])); ?>
                        <?php echo $this->Display->iconLink('delete.png', array('action'=>'delete', $contentPage['ContentPage']['id']), array('class' => 'tiptip dialog-confirm-delete', 'title' => 'Delete -> '.$contentPage['ContentPage']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php echo $this->element('pagination'); ?>
        <?php endif; ?>
    </div>
</div>
<?php echo $this->Display->LoadIt('TableDnD');?>
<script type="text/javascript">
$(document).ready(function(){
    $("#tableDnD").tableDnD({
        onDragClass:'selected'    
    });
});
</script>