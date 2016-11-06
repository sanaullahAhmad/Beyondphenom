    <div class="container dash-unit">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Patterns List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('patterns/create'), 'Create', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('patterns/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('patterns/word'), 'Word', 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Date Added</th>
                    <!-- <th>CollectionId</th> -->
                    <!-- <th>AdminId</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $start = 0;
                foreach ($patterns_data as $patterns)
                {
                    ?>
                    <tr>
                      <td><?php echo ++$start ?></td>
                      <td><?php echo $patterns->patternTitle ?></td>
                      <td>
                         <a taget="_blank" href="<?php echo base_url('public/uploads/patterns/'.$patterns->patternImage) ?>">
                            <img src="<?php echo base_url('public/uploads/patterns/'.$patterns->patternImage); ?>" alt="<?php echo $patterns->patternImage; ?>" height="100px" style="background: white; padding: 10px;" />
                        </a>
                    </td>
                    <td><?php echo $patterns->patternDate ?></td>
                    <!-- <td><?php echo $patterns->collectionId ?></td> -->
                    <!-- <td><?php echo $patterns->adminId ?></td> -->
                    <td style="text-align:center" width="200px">
                     <?php 
                     echo anchor(site_url('patterns/read/'.$patterns->patternId),'Read'); 
                     echo ' | '; 
                     echo anchor(site_url('patterns/update/'.$patterns->patternId),'Update'); 
                     echo ' | '; 
                     echo anchor(site_url('patterns/delete/'.$patterns->patternId),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                     ?>
                 </td>
             </tr>
             <?php
         }
         ?>
     </tbody>
 </table>
 <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
 <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
 <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
 <script type="text/javascript">
    $(document).ready(function () {
        $("#mytable").dataTable();
    });
</script>
</div>