<div class="users index">

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Users'); ?></h1>
            </div>
        </div><!-- end col md 12 -->
    </div><!-- end row -->


    <div class="row">

        <div class="col-md-3">
            <div class="actions">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo __('Actions'); ?></div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;' . __('New User'), array('action' => 'add'), array('escape' => false)); ?></li>
                            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List' . __('Posts'), array('controller' => 'posts', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New' . __('Post'), array('controller' => 'posts', 'action' => 'add'), array('escape' => false)); ?> </li>
                        </ul>
                    </div><!-- end body -->
                </div><!-- end panel -->
            </div><!-- end actions -->
        </div><!-- end col md 3 -->

        <div class="col-md-9">
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <thead>
                <tr>
                    <th nowrap><?php echo $this->Paginator->sort('id'); ?></th>
                    <th nowrap><?php echo $this->Paginator->sort('username'); ?></th>
                    <!--						<th nowrap>-->
                    <?php //echo $this->Paginator->sort('password'); ?><!--</th>-->
                    <th nowrap><?php echo $this->Paginator->sort('group'); ?></th>
                    <th nowrap><?php echo $this->Paginator->sort('role'); ?></th>
                    <th nowrap><?php echo $this->Paginator->sort('active'); ?></th>
                    <th nowrap><?php echo $this->Paginator->sort('number_of_posts'); ?></th>
                    <th nowrap><?php echo $this->Paginator->sort('created'); ?></th>
                    <th nowrap><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th class="actions"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): $numberOfPosts = count($user['Post']); ?>
                    <tr>
                        <td nowrap><?php echo h($user['User']['id']); ?>&nbsp;</td>
                        <td nowrap><?php echo h($user['User']['username']); ?>&nbsp;</td>
                        <!--						<td nowrap>-->
                        <?php //echo h($user['User']['password']); ?><!--&nbsp;</td>-->
                        <td nowrap><?php echo h($user['Group']['name']); ?>&nbsp;</td>
                        <td nowrap><?php echo h($user['User']['role']); ?>&nbsp;</td>
                        <td nowrap><?php echo h($user['User']['active'])? 'Yes': 'No'; ?>&nbsp;</td>
                        <td nowrap><?php echo $numberOfPosts; ?>&nbsp;</td>
                        <td nowrap><?php echo h($user['User']['created']); ?>&nbsp;</td>
                        <td nowrap><?php echo h($user['User']['modified']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $user['User']['id']), array('escape' => false)); ?>
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $user['User']['id']), array('escape' => false)); ?>
                            <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $user['User']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
                            <?php if ($user['User']['role'] != 'admin') {

                                //activate /deactivate user
                                if ($user['User']['active']) {
                                    //deactivate user
                                    echo $this->Form->postLink('Deactivate &nbsp', array('action' => 'activate', $user['User']['id'], 0), array('escape' => false));
                                } else {
                                    //activate user
                                    echo $this->Form->postLink('Activate &nbsp', array('action' => 'activate', $user['User']['id'], 1), array('escape' => false));
                                }

                                //promote /demote user
                                if ($user['User']['role'] == 'author') {
                                    //demote user
                                    echo $this->Form->postLink('Demote', array('action' => 'promote', $user['User']['id'], 'readers'), array('escape' => false));
                                } else if($user['User']['role'] == 'reader'){
                                    //promote user
                                    echo $this->Form->postLink('Promote', array('action' => 'promote', $user['User']['id'], 'authors'), array('escape' => false));
                                }
                            } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <p>
                <small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}'))); ?></small>
            </p>

            <?php
            $params = $this->Paginator->params();
            if ($params['pageCount'] > 1) {
                ?>
                <ul class="pagination pagination-sm">
                    <?php
                    echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev', 'tag' => 'li', 'escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                    echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a'));
                    echo $this->Paginator->next('Next &rarr;', array('class' => 'next', 'tag' => 'li', 'escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled', 'tag' => 'li', 'escape' => false));
                    ?>
                </ul>
            <?php } ?>

        </div> <!-- end col md 9 -->
    </div><!-- end row -->


</div><!-- end containing of content -->