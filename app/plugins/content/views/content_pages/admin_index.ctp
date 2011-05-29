<?php $this->Paginator->options(array('url' => $this->passedArgs)); ?>
<div class="box">
    <div class="title">
        <h5>Content Pages</h5>
        <?php echo $this->element('search'); ?>
        <ul class="links">
            <li><?php echo $this->Html->link('Add Content Page', array('action'=>'add'), array('class' => 'button sidebutton', 'escape' => false));?></li>
            <li><?php echo $this->Html->link('Sort View', array('action'=>'sort_list'), array('class' => 'button sidebutton', 'escape' => false));?></li>
        </ul>
    </div>
    <?php echo $this->Session->flash(); ?>
    <?php if (empty($contentPages)): ?>
        <?php echo $this->FlashIt->notice('There are no content pages to display'); ?>
    <?php else: ?>
    <?php if(count($breadcrumbs) > 0):?>
		<div class="breadcrumbs" style="height:17px;padding:0px;margin:0px;">
			<?php echo $html->link('Top Level', array('action'=>'index')); ?> <span style="font-size:14px;font-weight:bold;">&raquo;</span>
			<?php foreach($breadcrumbs as $key => $parent): ?>
				<?php echo $html->link($parent['ContentPage']['title'], array('action'=>'index', $parent['ContentPage']['id'])); ?>
				<?php echo (count($breadcrumbs)-1 != $key) ? '<span style="font-size:14px;font-weight:bold;">&raquo;</span>' : ''; ?>
			<?php endforeach; ?>
		</div>
	<?php endif;?>
    <div class="table">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo $this->Paginator->sort('name');?></th>
                <th><?php echo $this->Paginator->sort('Pretty Url', 'slug');?></th>
                <th><?php echo $this->Paginator->sort('active');?></th>
                <?php if($depth_reached === false):?>
					<th><?php echo $this->Paginator->sort('Sub Pages', 'childCount');?></th>
				<?php endif;?>
                <th><?php echo $this->Paginator->sort('created');?></th>
                <th><?php echo $this->Paginator->sort('modified');?></th>
                <th class="actions last">Actions</th>
            </tr>
            <?php $i = 1;?>
            <?php foreach ($contentPages as $contentPage): ?>
                <tr id="<?php echo $i++;?>">
                    <td><?php echo $contentPage['ContentPage']['name']; ?></td>
                    <td><?php echo $contentPage['ContentPage']['slug']; ?></td>
                    <td><?php echo $this->Display->iconLink(($contentPage['ContentPage']['active'] ? 'tick.png' : 'cross.png'), array('action' => 'toggle', 'ContentPage', 'active', $contentPage['ContentPage']['id']), array('class' => 'tiptip toggle', 'title' => 'Toggle Status -> '.$contentPage['ContentPage']['name'])); ?></td>
                    <?php if($depth_reached === false):?>
					<td>
						<?php if(!empty($contentPage['childCount']) && $contentPage['childCount'] > 0):?>
                            <?php echo $this->Display->iconLink('page_white_stack.png', array('action' => 'index', 'parent' => $contentPage['ContentPage']['id']));?> <?php echo $this->Display->iconLink('('.$contentPage['ContentPage']['childCount'].')', array('action' => 'index', 'parent' => $contentPage['ContentPage']['id']));?>
						<?php else:?>
                            <?php echo $this->Display->iconLink('page_white_add.png', array('action' => 'add', 'parent' => $contentPage['ContentPage']['id']));?>
						<?php endif;?>
					</td>
					<?php endif;?>
                    <td><?php echo $this->Display->friendly_datetime($contentPage['ContentPage']['created']); ?></td>
                    <td><?php echo $this->Display->friendly_datetime($contentPage['ContentPage']['modified']); ?></td>
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
<?php echo $this->Display->loadIt('Toggle');?>