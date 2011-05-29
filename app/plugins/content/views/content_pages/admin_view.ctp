<div id="tabs" class="box">
    <div class="title">
        <h5><?php  __('Content Page');?></h5>
        <ul class="links">
            <li><a href="#Details">Details</a></li>
            <li><a href="#Actions">Actions</a></li>
                                                <li><a href="#RelatedChildContentPage">ChildContentPage</a></li>
                    </ul>
    </div>
    <div id="Details">
        <dl><?php $i = 0; $class = ' class="altrow"';?>
    		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Slug'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['slug']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Content'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['content']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Keywords'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['meta_keywords']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['meta_description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['active']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Content Page'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($contentPage['ParentContentPage']['name'], array('controller' => 'content_pages', 'action' => 'view', $contentPage['ParentContentPage']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lft'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['lft']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rght'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['rght']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sort'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['sort']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contentPage['ContentPage']['modified']; ?>
			&nbsp;
		</dd>
        </dl>
    </div>
    <div id="Actions">
        <h3><?php __('Actions'); ?></h3>
        <ul>
    		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Content Page', true)), array('action' => 'edit', $contentPage['ContentPage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('Content Page', true)), array('action' => 'delete', $contentPage['ContentPage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contentPage['ContentPage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Content Pages', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Content Page', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Content Pages', true)), array('controller' => 'content_pages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Parent Content Page', true)), array('controller' => 'content_pages', 'action' => 'add')); ?> </li>
        </ul>
    </div>
<div id="RelatedChildContentPage">
	<h3><?php printf(__('Related %s', true), __('Content Pages', true));?></h3>
	<?php if (!empty($contentPage['ChildContentPage'])):?>
    <div class="table">
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Slug'); ?></th>
		<th><?php __('Content'); ?></th>
		<th><?php __('Meta Keywords'); ?></th>
		<th><?php __('Meta Description'); ?></th>
		<th><?php __('Active'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Lft'); ?></th>
		<th><?php __('Rght'); ?></th>
		<th><?php __('Sort'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions last"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($contentPage['ChildContentPage'] as $childContentPage):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childContentPage['id'];?></td>
			<td><?php echo $childContentPage['name'];?></td>
			<td><?php echo $childContentPage['title'];?></td>
			<td><?php echo $childContentPage['slug'];?></td>
			<td><?php echo $childContentPage['content'];?></td>
			<td><?php echo $childContentPage['meta_keywords'];?></td>
			<td><?php echo $childContentPage['meta_description'];?></td>
			<td><?php echo $childContentPage['active'];?></td>
			<td><?php echo $childContentPage['parent_id'];?></td>
			<td><?php echo $childContentPage['lft'];?></td>
			<td><?php echo $childContentPage['rght'];?></td>
			<td><?php echo $childContentPage['sort'];?></td>
			<td><?php echo $childContentPage['created'];?></td>
			<td><?php echo $childContentPage['modified'];?></td>
			<td class="actions last">
				<?php echo $this->Display->iconLink('pencil.png', array('controller' => 'content_pages', 'action' => 'edit', $childContentPage['id']), array('class' => 'tiptip', 'title' => 'Edit')); ?>
				<?php echo $this->Display->iconLink('delete.png', array('controller' => 'content_pages', 'action' => 'delete', $childContentPage['id']), array('class' => 'tiptip dialog-confirm-delete', 'title' => 'Delete')); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
    </div>
<?php endif; ?>

</div>
</div>
<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
</script>
<?php echo $this->element('dialog_confirm_delete'); ?>