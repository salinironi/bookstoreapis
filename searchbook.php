<?php include "header.php" ?>
<section class="main container"><div class="row">
        <br>
        <h4>You can search with any data in the Book Store. There is a parameter say 'match_filter' . If match_filter is 'any' then the database will be searched with OR condition and If match_filter is 'strict' then the database will be searched with AND condition. Please see the below two screenshots.</h4>
      <section class="demo-tour col-md-12">
 <img src="img/searchanyapi.png" alt="">
      </section></div><div class="row">
                <div class="col-md-12">
                    <br>
                    <p>
                        API : http://18.116.116.222/bookstoreapis/apis/apihandling?action=search <br>
                        Dummy Data : {"author":"Lucas Marthas","release_date":"31/03/2021","match_filter":"any"}
                    
                        
                    </p>
                </div></div>
    <div class="row">
      <section class="demo-tour col-md-12">
 <img src="img/searchstrictapi.png" alt="">
      </section></div><div class="row">
                <div class="col-md-12">
                    <br>
                    <p>
                        API : http://18.116.116.222/bookstoreapis/apis/apihandling?action=search <br>
                        Dummy Data : {"author":"Lucas Marthas","release_date":"31/03/2021","match_filter":"strict"}
                    
                        
                    </p>
                </div></div>
    
</section>
<?php include "footer.php" ?>