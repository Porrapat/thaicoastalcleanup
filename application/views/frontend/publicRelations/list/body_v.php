<div class="container" style="padding: 30px 0 60px;">
    <div class="row">
        <style type="text/css">
            
            .news-title {
                height: auto;
                font-size: 1.3em;
                margin-bottom: 8px;
            }
            
            .news-title a {

                font-size: 18px;

            }
           
            .media-body img {
                margin-left: 100px;
            }
            .btn-default {
                color: #795548;
                background-color: #fff;
                border-color: #795548;
            }
            .cat-item{
                padding: 8px;
            }
         
            .widget-area-rightbar .widget-title1 {
                padding: 10px 18px 10px;
            }
            @media (min-width: 280px)
             {
                .sidebar-tabing img {
                    width: 100%;
                   
                    height: auto;
                }
            }

        </style>

        <div class="col-md-12">
            <h3 class="widget-title">ข่าวสาร ทช.</h3>
                      
        </div>

        <dir class="col-md-9" style="margin-top: 1px;">

            <div class="sidebar-tabing" style="padding-left: 15px; padding-right: 15px;">

                <?php foreach($rs as $rowArticle) { ?>

                                    <div class="media"> 
                                        <a href="<?php echo base_url('publicRelations/content/' . $rowArticle['id']); ?>"> 
                                            <img class="d-flex mr-3" src="<?php echo base_url('assets/admin/blog/'.$rowArticle['Thumbnail_Url']) ?>" style="float:left;">
                                        </a>
                 <div class="media-body" style="padding-left: 10px">
                                        <div class="news-title">
                        <a href="<?php echo base_url('publicRelations/content/' . $rowArticle['id']); ?>" class="media-news">
                        <?php echo $rowArticle["Title_a"] ?>
                            
                        </a>
                                        </div>
    <div class="news-auther">
        <span class="time">
            <i class="fa fa-clock-o"></i> 
            <?php echo date("d-m-Y", strtotime($rowArticle['Publish_Date'])); ?>, 
            <i class="fa fa-folder-o"></i> <?php if($rowArticle['FK_Article_Category'] == 1){
                ?>
                ข่าวสาร
             <?php
             }else{
                ?>
                บทความ
                <?php
            }

            ?> </span>
        </div>

                                       <div style="margin-top: 5px; margin-bottom: 10px; "><?=mb_substr(strip_tags($rowArticle['Content']),0,400,'UTF-8')?>... </div> 
                                        <div class="textwidget-more" style="float: right; font-size: 14px; bottom: 0px"><a href="<?php echo base_url('publicRelations/content/' . $rowArticle['id']); ?>" class="btn btn-default btn-xs">อ่านต่อ... <i class="fa fa-arrow-right"></i></a></div>
                                    </div>
                                  </div>

                     <?php } ?>      

                      <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
                          </div>
                          
            
        </dir>


<style>
          .widget {


              -webkit-box-shadow: 0 0 5px 0 #e2e3e4;
              -moz-box-shadow: 0 0 5px 0 #e2e3e4;
              box-shadow: 0 0 5px 0 #e2e3e4;
              position: relative;
              margin-bottom: 30px;
              padding: 15px 12px 12px;
          }
          .widget-title {
              padding-bottom: 0px;
                  color: #2f3c4e;
          }
          .widget-title {
              font-size: 16px;
              font-weight: bold;
              padding-bottom: 10px;
              border-bottom: 2px solid #ecedee;
              margin-bottom: 20px;
              line-height: 28px;
              position: relative;
          }
          .tabs li {
    float: left;
    margin: 0 20px 10px 0;
    padding-bottom: 0;
    border-bottom: 0;
  }
  .widget li {
    display: block;
    list-style: none;
    color: #4b525c;
    border-bottom: 1px solid #ecedee;
    padding-bottom: 10px;
    margin-bottom: 10px;
    overflow: hidden;
    width: 100%;
  }
  .tabs li a {
    display: block;
    color: #000;
    text-decoration: none;
    background-color: #f5f5f5;
    padding: 0 10px;
    font-size: 20px;
  }
  .widget-posts-img, .widget-comments-img {
    float: left;
    position: relative;
    margin-right: 10px;
    overflow: hidden;
    text-align: center;
    height: 60px;
    width: 75px;
  }
  .widget-posts-content, .widget-comments-content {
    overflow: hidden;
    height: 100%;
    font-size: 13px;
  }
  .widget .widget-posts-content>a {
    line-height: 0.5em;
    color: #2f3c4e;
    text-decoration: none;
  }
  .widget .widget-posts-content>a:hover {
    line-height: 0.5em;
    color: #337ab7;
    text-decoration: none;
  }
  .widget-posts-content span {
    display: block;
    margin-bottom: 1px;
    font-size: 12px;
    text-transform: uppercase;
    color: #9ba1a8;
  }
  @media (min-width: 992px)
{
    .sidebar-tabing img {
                width: 260px;
                max-width: 260px;
                height: 190px;
            }

}

          </style>

        <div class="col-md-3" style="padding-right: 1px; padding-left: 1px;">
           



<div class="widget" style="background-color: #f5f5f5;">
              <div class="widget-title">
                <ul class="tabs" style="margin-bottom: 0px;     margin-top: -5px;">
                  <li class="tab"><a href="#" class="current">Most Viewed</a></li>
                  </ul>
                </div>





                <div class="widget-posts">
                  <ul>
<?php if(count($rs_view) != 0){ ?>
                    <?php foreach($rs_view as $row) { ?>
                    
                                        <li class="">
                    <div class="widget-posts-img">
                    <a href="<?php echo base_url('publicRelations/content/' . $row['id']); ?>">

                    <img src="<?php echo base_url('assets/admin/blog/'.$row['Thumbnail_Url']) ?>" class="img-responsive" style="height:65px; width:75px; overflow: hidden;">
                    </a>
                    </div>
                    <div class="widget-posts-content">
                    <a href="<?php echo base_url('publicRelations/content/' . $row['id']); ?>"><?php echo $row["Title_a"]  ?></a>
                    <span><i class="fa fa-clock-o"></i> <?php echo date("d-m-Y", strtotime($row['Publish_Date'])); ?></span>
                    </div>
                    </li>


                     <?php } ?> 
                <?php } ?>
                                                   
                    </ul>
                    </div>
            </div>
            

           
            

        </div>

   
</div>
</div>

