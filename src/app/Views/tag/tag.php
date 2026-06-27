<h2 class="mt-4">Tag Management</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url() ?>/add-tag">Add Tag</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tag Management</li>
  </ol>
</nav>
<div class="row mt-3">
  <div class="col-md-12">
    <div class="table-responsive">
      <div class="card mb-2">
        <div class="card-body filter">
          <form action="<?= base_url() ?>/filter-tag" method="GET" class="form-inline float-md-right mb-3">
            <div class="row">
              <div class="col-sm-6">
                <label>Tag Name</label>
                <input type="text" name="tag_name" value="<?php echo isset($tag_name) ? $tag_name : '' ?>" class="form-control mr-2">
              </div>
            </div>
            <div class="row">
              <div class="mt-2">
                <button class="btn btn-outline-success">Filter</button>
                <a href="<?= base_url() ?>/all-tags" class="btn btn-outline-danger">Clear</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 20%" class="text-right">Date</th>
            <th style="width: 60%">Tag Name</th>
            <th style="width: 20%" class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tags as $value) : ?>
            <tr>
              <td class="text-right"><?php echo date($settings['date_format'], strtotime($value['create_date'])) ?><br />
                <hr /><?php echo date($settings['time_format'], strtotime($value['create_time'])) ?>
              </td>
              <td><?php echo $value['tag_name'] ?></td>
              <td class="text-right">
                <a class="btn btn-sm btn-info" href="<?= base_url() ?>/edit-tag/<?= $value['tag_id'] ?>">Edit</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
      <?php
      if (isset($pager)) :
        echo $pager->links('tag', 'bootstrap_pagination');
      endif;
      ?>
    </div>
  </div>
</div>
<script>
  jQ.push(function() {
    $("#tag").addClass('active');
  });
</script>