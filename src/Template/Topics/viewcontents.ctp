<div class="right_col" role="main" style="margin-bottom: 55px;">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><small></small></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Subjects Contents</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">Please Click on Any Topic To Read</div>
<div class="panel-body">

                            <?php foreach ($sub_contents as $topic) { ?>
                                  <button class="btn btn-info" onclick="getTopics(<?= $topic->id ?>)"><?= $topic->title ?> </button>
                              <?php } ?>
</div>

                        </div>
                        </div>
                        <div class="col-md-7" id="contents">

                           

                            Click on any topic to view the contents here


                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<script>
    function getTopics(id) {
        // alert(id);
        $.ajax({
            url: '/nerp/topics/gettopics/' + id,
            method: 'GET',
            dataType: 'text',
            success: function (response) {
                  console.log(response); return;
                document.getElementById('contents').innerHTML = "";
                document.getElementById('contents').innerHTML = response;
                //location.href = redirect;
            }
        });
    }
</script>