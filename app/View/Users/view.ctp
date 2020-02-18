<div class="users view">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('User'); ?></h1>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-3">
            <div class="actions">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo __('Actions'); ?></div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit User'), array('action' => 'edit', $user['User']['id']), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete User'), array('action' => 'delete', $user['User']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('action' => 'add'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Posts'), array('controller' => 'posts', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Post'), array('controller' => 'posts', 'action' => 'add'), array('escape' => false)); ?> </li>
                        </ul>
                    </div><!-- end body -->
                </div><!-- end panel -->
            </div><!-- end actions -->
        </div><!-- end col md 3 -->

        <div class="col-md-9">
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <tbody>
                <tr>
                    <th><?php echo __('Id'); ?></th>
                    <td>
                        <?php echo h($user['User']['id']); ?>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <th><?php echo __('Username'); ?></th>
                    <td>
                        <?php echo h($user['User']['username']); ?>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <th><?php echo __('Password'); ?></th>
                    <td>
                        <?php echo h($user['User']['password']); ?>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <th><?php echo __('Group Id'); ?></th>
                    <td>
                        <?php echo h($user['User']['group_id']); ?>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <th><?php echo __('Role'); ?></th>
                    <td>
                        <?php echo h($user['User']['role']); ?>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <th><?php echo __('Active'); ?></th>
                    <td>
                        <?php echo h($user['User']['active'])?"Yes":"No"; ?>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <th><?php echo __('Created'); ?></th>
                    <td>
                        <?php echo h($user['User']['created']); ?>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <th><?php echo __('Modified'); ?></th>
                    <td>
                        <?php echo h($user['User']['modified']); ?>
                        &nbsp;
                    </td>
                </tr>
                </tbody>
            </table>

        </div><!-- end col md 9 -->

    </div>
</div>

<div class="related row">
    <div class="col-md-12">
        <h3><?php echo __('Related Posts'); ?></h3>
        <?php if (!empty($user['Post'])): ?>
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <thead>
                <tr>
                    <th><?php echo __('Id'); ?></th>
                    <th><?php echo __('Title'); ?></th>
                    <th><?php echo __('Body'); ?></th>
                    <th><?php echo __('Created'); ?></th>
                    <th><?php echo __('Modified'); ?></th>
                    <th><?php echo __('User Id'); ?></th>
                    <th class="actions"></th>
                </tr>
                <thead>
                <tbody>
                <?php foreach ($user['Post'] as $post): ?>
                    <tr>
                        <td><?php echo $post['id']; ?></td>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['body']; ?></td>
                        <td><?php echo $post['created']; ?></td>
                        <td><?php echo $post['modified']; ?></td>
                        <td><?php echo $post['user_id']; ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'posts', 'action' => 'view', $post['id']), array('escape' => false)); ?>
                            <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'posts', 'action' => 'edit', $post['id']), array('escape' => false)); ?>
                            <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'posts', 'action' => 'delete', $post['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $post['id'])); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="actions">
            <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Post'), array('controller' => 'posts', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?>
        </div>
    </div><!-- end col md 12 -->
</div>
