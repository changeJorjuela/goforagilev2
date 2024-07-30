@extends("layout")

@section('titulo')
Consolidado General
@endsection

@section('contenido')
<div class="row gutters">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="reports-tab" data-toggle="tab" href="#reports" role="tab" aria-controls="reports" aria-selected="true" aria-expanded="true">Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false" aria-expanded="false">Sales</a>
                    </li>
                </ul>
            </div>
            <div class="toggle-switch tr-xl">
                <input type="checkbox" class="check" />
                <b class="b switch"></b>
                <b class="b track"></b>
            </div>
            <div class="card-body">
                <div class="tab-content plain" id="myTabContent">
                    <div class="tab-pane fade active show" id="reports" role="tabpanel" aria-labelledby="reports-tab" aria-expanded="true">
                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-md-5 col-sm-12">
                                <h6 class="card-title mt-0">Visitors</h6>
                                <div class="chartist custom-one">
                                    <div class="line-chart"></div>
                                </div>
                                <div class="download-details">
                                    <p>21<sup>%</sup> more visitors than last month</p>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="monthly-avg">
                                    <h6>Monthly Average</h6>
                                    <div class="avg-block">
                                        <h4 class="avg-total text-secondary">9500</h4>
                                        <h6 class="avg-label">
                                            Visitors
                                        </h6>
                                    </div>
                                    <div class="avg-block">
                                        <h4 class="avg-total text-primary">$510<sup>k</sup></h4>
                                        <h6 class="avg-label">
                                            Sales
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-12">
                                <h6 class="card-title mt-0">Orders</h6>
                                <div class="chartist custom-two">
                                    <div class="line-chart2"></div>
                                </div>
                                <div class="download-details">
                                    <p>15<sup>%</sup> more sales than last month</p>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->
                    </div>
                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab" aria-expanded="false">
                        <!-- Row starts -->
                        <div class="row align-items-center gutters">
                            <div class="col-md-3 col-sm-12">
                                <div class="monthly-avg plain">
                                    <h6>Weekly</h6>
                                    <div class="avg-block">
                                        <h4 class="avg-total text-secondary">3,200</h4>
                                        <h6 class="avg-label">
                                            Direct
                                        </h6>
                                    </div>
                                    <div class="avg-block">
                                        <h4 class="avg-total text-primary">$470<sup>k</sup></h4>
                                        <h6 class="avg-label">
                                            Online
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="customScroll3">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <ul class="stocks">
                                                <li>
                                                    <p class="clearfix">Apple Inc
                                                        <span><i class="icon-arrow-up-right2 text-success"></i>
                                                            46,540<small class="text-success">+2.005</small></span>
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="clearfix">Google Inc<span><i class="icon-arrow-up-right2 text-success"></i>8219<small class="text-success">-4.031</small></span></p>
                                                </li>
                                                <li>
                                                    <p class="clearfix">Yahoo Inc<span><i class="icon-arrow-down-right2 text-danger"></i>3188<small class="text-danger">+7.652</small></span></p>
                                                </li>
                                                <li>
                                                    <p class="clearfix">Facebook Inc<span><i class="icon-arrow-up-right2 text-success"></i>46545<small class="text-success">+11.82</small></span></p>
                                                </li>
                                                <li>
                                                    <p class="clearfix">Ebay Inc<span><i class="icon-arrow-down-right2 text-danger"></i>662<small class="text-danger">-5.281</small></span></p>
                                                </li>
                                                <li>
                                                    <p class="clearfix">Amazon Inc<span><i class="icon-arrow-up-right2 text-success"></i>27873<small class="text-success">+7.318</small></span></p>
                                                </li>
                                                <li>
                                                    <p class="clearfix">Microsoft<span><i class="icon-arrow-up-right2 text-success"></i>3964<small class="text-success">-3.091</small></span></p>
                                                </li>
                                                <li>
                                                    <p class="clearfix">Federal Bank<span><i class="icon-arrow-up-right2 text-success"></i>10760<small class="text-success">+4.585</small></span></p>
                                                </li>
                                                <li>
                                                    <p class="clearfix">Nicco Corp<span><i class="icon-arrow-down-right2 text-danger"></i>260<small class="text-danger">-6.955</small></span></p>
                                                </li>
                                                <li>
                                                    <p class="clearfix">Uflex<span><i class="icon-arrow-up-right2 text-success"></i>37095<small class="text-success">+5.079</small></span></p>
                                                </li>
                                                <li>
                                                    <p class="clearfix">Trivago NV<span><i class="icon-arrow-up-right2 text-success"></i>1851<small class="text-success">+9.555</small></span></p>
                                                </li>
                                                <li>
                                                    <p class="clearfix">Cobham PLC<span><i class="icon-arrow-down-right2 text-danger"></i>364<small class="text-danger">-8.432</small></span></p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="monthly-avg plain">
                                    <h6>Monthly</h6>
                                    <div class="avg-block">
                                        <h4 class="avg-total text-secondary">29,300</h4>
                                        <h6 class="avg-label">
                                            Direct
                                        </h6>
                                    </div>
                                    <div class="avg-block">
                                        <h4 class="avg-total text-primary">$7,160<sup>k</sup></h4>
                                        <h6 class="avg-label">
                                            Online
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->

<!-- Row start -->
<div class="row gutters">
    <div class="col-md-3 col-sm-6">
        <div class="info-stats4">
            <div class="icon-type pull-left">
                <i class="icon-announcement"></i>
            </div>
            <div class="sale-num">
                <h4>450</h4>
                <p>Received</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="info-stats4">
            <div class="icon-type pull-left">
                <i class="icon-drafts"></i>
            </div>
            <div class="sale-num">
                <h4>890</h4>
                <p>Pending</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="info-stats4">
            <div class="icon-type pull-left">
                <i class="icon-chat2"></i>
            </div>
            <div class="sale-num">
                <h4>185</h4>
                <p>Reviews</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="info-stats4">
            <div class="icon-type pull-left">
                <i class="icon-assignment_turned_in"></i>
            </div>
            <div class="sale-num">
                <h4>570</h4>
                <p>Completed</p>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->

<!-- Row start -->
<div class="row gutters">
    <div class="col-md-4 col-sm-6">
        <div class="card">
            <div class="card-header">Emails</div>
            <div class="card-body">
                <div class="chartist custom-two">
                    <div class="pie-chart"></div>
                </div>
                <div class="row gutters">
                    <div class="col-sm-6 col">
                        <div class="info-stats">
                            <span class="info-label"></span>
                            <p class="info-title">Sent</p>
                            <h4 class="info-total">985</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 col">
                        <div class="info-stats">
                            <span class="info-label red"></span>
                            <p class="info-title">Opened</p>
                            <h4 class="info-total">476</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card">
            <div class="card-header">Customers</div>
            <div class="card-body">
                <div class="chartist custom-two">
                    <div class="pie-chart2"></div>
                </div>
                <div class="row gutters">
                    <div class="col-sm-6 col">
                        <div class="info-stats">
                            <span class="info-label"></span>
                            <p class="info-title">New</p>
                            <h4 class="info-total">367</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 col">
                        <div class="info-stats">
                            <span class="info-label red"></span>
                            <p class="info-title">Returned</p>
                            <h4 class="info-total">555</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="card">
            <div class="card-header">Deals</div>
            <div class="card-body">
                <div class="chartist custom-two">
                    <div class="pie-chart3"></div>
                </div>
                <div class="row gutters">
                    <div class="col-sm-6 col">
                        <div class="info-stats">
                            <span class="info-label"></span>
                            <p class="info-title">Claimed</p>
                            <h4 class="info-total">662</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 col">
                        <div class="info-stats">
                            <span class="info-label red"></span>
                            <p class="info-title">Expired</p>
                            <h4 class="info-total">133</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->

<!-- Row start -->
<div class="row gutters">
    <div class="col-md-8 col-sm-12">
        <div class="card">
            <div class="card-header">Saley by Location</div>
            <div class="card-body">
                <div class="row gutter">
                    <div class="col-sm-12">
                        <div id="world-map-markers" class="chart-height-2"></div>
                        <div class="row gutters">
                            <div class="col-sm-4 col">
                                <div class="info-stats">
                                    <span class="info-label"></span>
                                    <h6 class="info-title">USA</h6>
                                    <h5 class="info-total">65,550</h5>
                                </div>
                            </div>
                            <div class="col-sm-4 col">
                                <div class="info-stats">
                                    <span class="info-label red"></span>
                                    <h6 class="info-title">EUROPE</h6>
                                    <h5 class="info-total">32,765</h5>
                                </div>
                            </div>
                            <div class="col-sm-4 col">
                                <div class="info-stats">
                                    <span class="info-label green"></span>
                                    <h6 class="info-title">ASIA</h6>
                                    <h5 class="info-total">89,495</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="card">
            <div class="card-header">Settings</div>
            <div class="card-body">
                <ul class="settings">
                    <li>
                        <div class="row gutter">
                            <div class="col-lg-10 col-md-9 col-sm-8">
                                <p>Check for new emails for every 15 mins</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="toggle-switch">
                                    <input type="checkbox" class="check">
                                    <b class="b switch"></b>
                                    <b class="b track"></b>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row gutter">
                            <div class="col-lg-10 col-md-9 col-sm-8">
                                <p>Enable sound notifications</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="toggle-switch">
                                    <input type="checkbox" class="check" checked="checked">
                                    <b class="b switch"></b>
                                    <b class="b track"></b>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row gutter">
                            <div class="col-lg-10 col-md-9 col-sm-8">
                                <p>Delete trash emails for every week</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="toggle-switch">
                                    <input type="checkbox" class="check" checked="checked">
                                    <b class="b switch"></b>
                                    <b class="b track"></b>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row gutter">
                            <div class="col-lg-10 col-md-9 col-sm-8">
                                <p>Move deleted messages to trash folder</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="toggle-switch">
                                    <input type="checkbox" class="check">
                                    <b class="b switch"></b>
                                    <b class="b track"></b>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row gutter">
                            <div class="col-lg-10 col-md-9 col-sm-8">
                                <p>Add me as a friend</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="toggle-switch">
                                    <input type="checkbox" class="check">
                                    <b class="b switch"></b>
                                    <b class="b track"></b>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row gutter">
                            <div class="col-lg-10 col-md-9 col-sm-8">
                                <p>Makes me group Admin</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="toggle-switch">
                                    <input type="checkbox" class="check">
                                    <b class="b switch"></b>
                                    <b class="b track"></b>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->

<!-- Row start -->
<div class="row gutters">
    <div class="col-sm-12">
        <div class="card m-0">
            <div class="card-body">
                <table id="scrollVertical" class="table table-striped table-bordered m-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Location</th>
                            <th>Product code</th>
                            <th>Purchased on</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Edinburgh</td>
                            <td>#127654</td>
                            <td>2017/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2017/07/25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2017/01/12</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2017/03/29</td>
                            <td>$433,060</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2017/11/28</td>
                            <td>$162,700</td>
                        </tr>
                        <tr>
                            <td>Brielle Williamson</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2017/12/02</td>
                            <td>$372,000</td>
                        </tr>
                        <tr>
                            <td>Herrod Chandler</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>59</td>
                            <td>2017/08/06</td>
                            <td>$137,500</td>
                        </tr>
                        <tr>
                            <td>Rhona Davidson</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Tokyo</td>
                            <td>55</td>
                            <td>2017/10/14</td>
                            <td>$327,900</td>
                        </tr>
                        <tr>
                            <td>Colleen Hurst</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>39</td>
                            <td>2017/09/15</td>
                            <td>$205,500</td>
                        </tr>
                        <tr>
                            <td>Sonya Frost</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Edinburgh</td>
                            <td>23</td>
                            <td>2017/12/13</td>
                            <td>$103,600</td>
                        </tr>
                        <tr>
                            <td>Jena Gaines</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>London</td>
                            <td>30</td>
                            <td>2017/12/19</td>
                            <td>$90,560</td>
                        </tr>
                        <tr>
                            <td>Quinn Flynn</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2017/03/03</td>
                            <td>$342,000</td>
                        </tr>
                        <tr>
                            <td>Charde Marshall</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>36</td>
                            <td>2017/10/16</td>
                            <td>$470,600</td>
                        </tr>
                        <tr>
                            <td>Haley Kennedy</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>London</td>
                            <td>43</td>
                            <td>2017/12/18</td>
                            <td>$313,500</td>
                        </tr>
                        <tr>
                            <td>Tatyana Fitzpatrick</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>London</td>
                            <td>19</td>
                            <td>2017/03/17</td>
                            <td>$385,750</td>
                        </tr>
                        <tr>
                            <td>Michael Silva</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>London</td>
                            <td>66</td>
                            <td>2017/11/27</td>
                            <td>$198,500</td>
                        </tr>
                        <tr>
                            <td>Paul Byrd</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>New York</td>
                            <td>64</td>
                            <td>2017/06/09</td>
                            <td>$725,000</td>
                        </tr>
                        <tr>
                            <td>Gloria Little</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>New York</td>
                            <td>59</td>
                            <td>2017/04/10</td>
                            <td>$237,500</td>
                        </tr>
                        <tr>
                            <td>Bradley Greer</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>London</td>
                            <td>41</td>
                            <td>2017/10/13</td>
                            <td>$132,000</td>
                        </tr>
                        <tr>
                            <td>Dai Rios</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Edinburgh</td>
                            <td>35</td>
                            <td>2017/09/26</td>
                            <td>$217,500</td>
                        </tr>
                        <tr>
                            <td>Jenette Caldwell</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>New York</td>
                            <td>30</td>
                            <td>2017/09/03</td>
                            <td>$345,000</td>
                        </tr>
                        <tr>
                            <td>Yuri Berry</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>New York</td>
                            <td>40</td>
                            <td>2017/06/25</td>
                            <td>$675,000</td>
                        </tr>
                        <tr>
                            <td>Caesar Vance</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>New York</td>
                            <td>21</td>
                            <td>2017/12/12</td>
                            <td>$106,450</td>
                        </tr>
                        <tr>
                            <td>Doris Wilder</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Sidney</td>
                            <td>23</td>
                            <td>2017/09/20</td>
                            <td>$85,600</td>
                        </tr>
                        <tr>
                            <td>Angelica Ramos</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>London</td>
                            <td>47</td>
                            <td>2017/10/09</td>
                            <td>$1,200,000</td>
                        </tr>
                        <tr>
                            <td>Gavin Joyce</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Edinburgh</td>
                            <td>42</td>
                            <td>2017/12/22</td>
                            <td>$92,575</td>
                        </tr>
                        <tr>
                            <td>Jennifer Chang</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Singapore</td>
                            <td>28</td>
                            <td>2017/11/14</td>
                            <td>$357,650</td>
                        </tr>
                        <tr>
                            <td>Brenden Wagner</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>28</td>
                            <td>2017/06/07</td>
                            <td>$206,850</td>
                        </tr>
                        <tr>
                            <td>Fiona Green</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>48</td>
                            <td>2017/03/11</td>
                            <td>$850,000</td>
                        </tr>
                        <tr>
                            <td>Shou Itou</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Tokyo</td>
                            <td>20</td>
                            <td>2017/08/14</td>
                            <td>$163,000</td>
                        </tr>
                        <tr>
                            <td>Michelle House</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Sidney</td>
                            <td>37</td>
                            <td>2017/06/02</td>
                            <td>$95,400</td>
                        </tr>
                        <tr>
                            <td>Suki Burks</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>London</td>
                            <td>53</td>
                            <td>2017/10/22</td>
                            <td>$114,500</td>
                        </tr>
                        <tr>
                            <td>Prescott Bartlett</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>London</td>
                            <td>27</td>
                            <td>2017/05/07</td>
                            <td>$145,000</td>
                        </tr>
                        <tr>
                            <td>Gavin Cortez</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>22</td>
                            <td>2017/10/26</td>
                            <td>$235,500</td>
                        </tr>
                        <tr>
                            <td>Martena Mccray</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Edinburgh</td>
                            <td>46</td>
                            <td>2017/03/09</td>
                            <td>$324,050</td>
                        </tr>
                        <tr>
                            <td>Unity Butler</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>47</td>
                            <td>2017/12/09</td>
                            <td>$85,675</td>
                        </tr>
                        <tr>
                            <td>Howard Hatfield</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>51</td>
                            <td>2017/12/16</td>
                            <td>$164,500</td>
                        </tr>
                        <tr>
                            <td>Hope Fuentes</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>41</td>
                            <td>2017/02/12</td>
                            <td>$109,850</td>
                        </tr>
                        <tr>
                            <td>Vivian Harrell</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>62</td>
                            <td>2017/02/14</td>
                            <td>$452,500</td>
                        </tr>
                        <tr>
                            <td>Timothy Mooney</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>London</td>
                            <td>37</td>
                            <td>2017/12/11</td>
                            <td>$136,200</td>
                        </tr>
                        <tr>
                            <td>Jackson Bradshaw</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>New York</td>
                            <td>65</td>
                            <td>2017/09/26</td>
                            <td>$645,750</td>
                        </tr>
                        <tr>
                            <td>Olivia Liang</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Singapore</td>
                            <td>64</td>
                            <td>2017/02/03</td>
                            <td>$234,500</td>
                        </tr>
                        <tr>
                            <td>Bruno Nash</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>London</td>
                            <td>38</td>
                            <td>2017/05/03</td>
                            <td>$163,500</td>
                        </tr>
                        <tr>
                            <td>Sakura Yamamoto</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Tokyo</td>
                            <td>37</td>
                            <td>2017/08/19</td>
                            <td>$139,575</td>
                        </tr>
                        <tr>
                            <td>Thor Walton</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2017/08/11</td>
                            <td>$98,540</td>
                        </tr>
                        <tr>
                            <td>Finn Camacho</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>47</td>
                            <td>2017/07/07</td>
                            <td>$87,500</td>
                        </tr>
                        <tr>
                            <td>Serge Baldwin</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Singapore</td>
                            <td>64</td>
                            <td>2017/04/09</td>
                            <td>$138,575</td>
                        </tr>
                        <tr>
                            <td>Zenaida Frank</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>New York</td>
                            <td>63</td>
                            <td>2017/01/04</td>
                            <td>$125,250</td>
                        </tr>
                        <tr>
                            <td>Zorita Serrano</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>56</td>
                            <td>2017/06/01</td>
                            <td>$115,000</td>
                        </tr>
                        <tr>
                            <td>Jennifer Acosta</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Edinburgh</td>
                            <td>43</td>
                            <td>2017/02/01</td>
                            <td>$75,650</td>
                        </tr>
                        <tr>
                            <td>Cara Stevens</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>New York</td>
                            <td>46</td>
                            <td>2017/12/06</td>
                            <td>$145,600</td>
                        </tr>
                        <tr>
                            <td>Hermione Butler</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>London</td>
                            <td>47</td>
                            <td>2017/03/21</td>
                            <td>$356,250</td>
                        </tr>
                        <tr>
                            <td>Lael Greer</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>London</td>
                            <td>21</td>
                            <td>2017/02/27</td>
                            <td>$103,500</td>
                        </tr>
                        <tr>
                            <td>Jonas Alexander</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>San Francisco</td>
                            <td>30</td>
                            <td>2017/07/14</td>
                            <td>$86,500</td>
                        </tr>
                        <tr>
                            <td>Shad Decker</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Edinburgh</td>
                            <td>51</td>
                            <td>2017/11/13</td>
                            <td>$183,000</td>
                        </tr>
                        <tr>
                            <td>Michael Bruce</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>Singapore</td>
                            <td>29</td>
                            <td>2017/06/27</td>
                            <td>$183,000</td>
                        </tr>
                        <tr>
                            <td>Donna Snider</td>
                            <td><img src="img/user.png" class="img-30" alt="product" /></td>
                            <td>New York</td>
                            <td>27</td>
                            <td>2017/01/25</td>
                            <td>$112,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection