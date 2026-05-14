<x-admin-master>
    @section('title', 'Dashboard')
    @section('content')
        <x-breadcrumb></x-breadcrumb>
        <div class="row">
            <div class="col-xl-12">
                <div class="card crm-widget">
                    <div class="p-0 card-body">
                        <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
                            <div class="col">
                                <div class="px-3 py-4">
                                    <h5 class="text-muted text-uppercase fs-13">Campaign Sent <i class="align-middle ri-arrow-up-circle-line text-success fs-18 float-end"></i></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-space-ship-line display-6 text-muted cfs-22"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" data-target="197">197</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="px-3 py-4 mt-3 mt-md-0">
                                    <h5 class="text-muted text-uppercase fs-13">Annual Profit <i class="align-middle ri-arrow-up-circle-line text-success fs-18 float-end"></i></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-exchange-dollar-line display-6 text-muted cfs-22"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22">$<span class="counter-value" data-target="489.4">489.4</span>k</h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="px-3 py-4 mt-3 mt-md-0">
                                    <h5 class="text-muted text-uppercase fs-13">Lead Conversation <i class="align-middle ri-arrow-down-circle-line text-danger fs-18 float-end"></i></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-pulse-line display-6 text-muted cfs-22"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" data-target="32.89">32.89</span>%</h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="px-3 py-4 mt-3 mt-lg-0">
                                    <h5 class="text-muted text-uppercase fs-13">Daily Average Income <i class="align-middle ri-arrow-up-circle-line text-success fs-18 float-end"></i></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-trophy-line display-6 text-muted cfs-22"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22">$<span class="counter-value" data-target="1596.5">1,596.5</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="px-3 py-4 mt-3 mt-lg-0">
                                    <h5 class="text-muted text-uppercase fs-13">Annual Deals <i class="align-middle ri-arrow-down-circle-line text-danger fs-18 float-end"></i></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-service-line display-6 text-muted cfs-22"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0 cfs-22"><span class="counter-value" data-target="2659">2,659</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-xxl-3 col-md-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="mb-0 card-title flex-grow-1">Sales Forecast</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Nov 2021<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Oct 2021</a>
                                    <a class="dropdown-item" href="#">Nov 2021</a>
                                    <a class="dropdown-item" href="#">Dec 2021</a>
                                    <a class="dropdown-item" href="#">Jan 2022</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="pb-0 card-body">
                        <div id="sales-forecast-chart" data-colors="[&quot;--vz-primary&quot;, &quot;--vz-success&quot;, &quot;--vz-warning&quot;]" data-colors-minimal="[&quot;--vz-primary-rgb, 0.75&quot;, &quot;--vz-primary&quot;, &quot;--vz-primary-rgb, 0.55&quot;]" data-colors-creative="[&quot;--vz-primary&quot;, &quot;--vz-secondary&quot;, &quot;--vz-info&quot;]" data-colors-corporate="[&quot;--vz-primary&quot;, &quot;--vz-success&quot;, &quot;--vz-secondary&quot;]" data-colors-galaxy="[&quot;--vz-primary&quot;, &quot;--vz-secondary&quot;, &quot;--vz-info&quot;]" data-colors-classic="[&quot;--vz-primary&quot;, &quot;--vz-warning&quot;, &quot;--vz-secondary&quot;]" class="apex-charts" dir="ltr" style="min-height: 356px;"><div id="apexcharts8dfude08" class="apexcharts-canvas apexcharts8dfude08 apexcharts-theme-" style="width: 294px; height: 341px;"><svg id="SvgjsSvg1751" width="294" height="341" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"><foreignObject x="0" y="0" width="294" height="341"><div xmlns="http://www.w3.org/1999/xhtml" style="position: relative; height: 100%; width: 100%;"><div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom" style="right: 0px; position: absolute; left: 20px; top: 282px; max-height: 170.5px;"><div class="apexcharts-legend-series" rel="1" seriesname="Goal" data:collapsed="false" style="margin: 0px 8px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="height: 16px; width: 16px; left: 0px; top: 0px;"><svg id="SvgjsSvg1754" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"><defs id="SvgjsDefs1755"><clipPath id="gridRectMask8dfude08"><rect id="SvgjsRect1771" width="230.33102416992188" height="200.988" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectBarMask8dfude08"><rect id="SvgjsRect1772" width="239.33102416992188" height="209.988" x="-4.5" y="-4.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMask8dfude08"><rect id="SvgjsRect1773" width="230.33102416992188" height="200.988" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask8dfude08"></clipPath><clipPath id="nonForecastMask8dfude08"></clipPath></defs><path id="SvgjsPath1756" d="M -6.222222222222222 -6.222222222222222
L 6.222222222222222 -6.222222222222222
L 6.222222222222222 6.222222222222222
L -6.222222222222222 6.222222222222222
Z" fill="#405189" fill-opacity="1" stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="square" class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-square" style="transform: translate(50%, 50%);"></path></svg></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="Goal" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 500; font-family: Helvetica, Arial, sans-serif;">Goal</span></div><div class="apexcharts-legend-series" rel="2" seriesname="PendingxForcast" data:collapsed="false" style="margin: 0px 8px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="height: 16px; width: 16px; left: 0px; top: 0px;"><svg id="SvgjsSvg1757" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"><defs id="SvgjsDefs1758"></defs><path id="SvgjsPath1759" d="M -6.222222222222222 -6.222222222222222
L 6.222222222222222 -6.222222222222222
L 6.222222222222222 6.222222222222222
L -6.222222222222222 6.222222222222222
Z" fill="#0ab39c" fill-opacity="1" stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="square" class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-square" style="transform: translate(50%, 50%);"></path></svg></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="Pending%20Forcast" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 500; font-family: Helvetica, Arial, sans-serif;">Pending Forcast</span></div><div class="apexcharts-legend-series" rel="3" seriesname="Revenue" data:collapsed="false" style="margin: 0px 8px;"><span class="apexcharts-legend-marker" rel="3" data:collapsed="false" style="height: 16px; width: 16px; left: 0px; top: 0px;"><svg id="SvgjsSvg1760" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"><defs id="SvgjsDefs1761"></defs><path id="SvgjsPath1762" d="M -6.222222222222222 -6.222222222222222
L 6.222222222222222 -6.222222222222222
L 6.222222222222222 6.222222222222222
L -6.222222222222222 6.222222222222222
Z" fill="#f7b84b" fill-opacity="1" stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="square" class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-square" style="transform: translate(50%, 50%);"></path></svg></span><span class="apexcharts-legend-text" rel="3" i="2" data:default-text="Revenue" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 500; font-family: Helvetica, Arial, sans-serif;">Revenue</span></div></div></div><style type="text/css">
.apexcharts-legend {
display: flex;
overflow: auto;
padding: 0 10px;
}
.apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
flex-wrap: wrap
}
.apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
flex-direction: column;
bottom: 0;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
justify-content: flex-start;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
justify-content: center;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
justify-content: flex-end;
}
.apexcharts-legend-series {
cursor: pointer;
line-height: normal;
display: flex;
align-items: center;
}
.apexcharts-legend-text {
position: relative;
font-size: 14px;
}
.apexcharts-legend-text *, .apexcharts-legend-marker * {
pointer-events: none;
}
.apexcharts-legend-marker {
position: relative;
display: flex;
align-items: center;
justify-content: center;
cursor: pointer;
margin-right: 1px;
}

.apexcharts-legend-series.apexcharts-no-click {
cursor: auto;
}
.apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
display: none !important;
}
.apexcharts-inactive-legend {
opacity: 0.45;
}</style></foreignObject><g id="SvgjsG1774" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g><g id="SvgjsG1775" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g><g id="SvgjsG1828" class="apexcharts-yaxis" rel="0" transform="translate(23.668975830078125, 0)"><g id="SvgjsG1829" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1831" font-family="Helvetica, Arial, sans-serif" x="20" y="33.666666666666664" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1832">$40k</tspan><title>$40k</title></text><text id="SvgjsText1834" font-family="Helvetica, Arial, sans-serif" x="20" y="83.91366666666667" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1835">$30k</tspan><title>$30k</title></text><text id="SvgjsText1837" font-family="Helvetica, Arial, sans-serif" x="20" y="134.16066666666666" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1838">$20k</tspan><title>$20k</title></text><text id="SvgjsText1840" font-family="Helvetica, Arial, sans-serif" x="20" y="184.40766666666667" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1841">$10k</tspan><title>$10k</title></text><text id="SvgjsText1843" font-family="Helvetica, Arial, sans-serif" x="20" y="234.65466666666669" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1844">$0k</tspan><title>$0k</title></text></g></g><g id="SvgjsG1753" class="apexcharts-inner apexcharts-graphical" transform="translate(53.668975830078125, 30)"><defs id="SvgjsDefs1752"><linearGradient id="SvgjsLinearGradient1766" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1767" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop1768" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop1769" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient></defs><rect id="SvgjsRect1770" width="49.90505523681641" height="200.988" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1766)" class="apexcharts-xcrosshairs" y2="200.988" filter="none" fill-opacity="0.9"></rect><g id="SvgjsG1807" class="apexcharts-grid"><g id="SvgjsG1808" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine1812" x1="0" y1="50.247" x2="230.33102416992188" y2="50.247" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1813" x1="0" y1="100.494" x2="230.33102416992188" y2="100.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1814" x1="0" y1="150.74099999999999" x2="230.33102416992188" y2="150.74099999999999" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1809" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine1817" x1="0" y1="200.988" x2="230.33102416992188" y2="200.988" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1816" x1="0" y1="1" x2="0" y2="200.988" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1810" class="apexcharts-grid-borders"><line id="SvgjsLine1811" x1="0" y1="0" x2="230.33102416992188" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1815" x1="0" y1="200.988" x2="230.33102416992188" y2="200.988" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1827" x1="0" y1="200.988" x2="230.33102416992188" y2="200.988" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line></g><g id="SvgjsG1776" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1777" class="apexcharts-series" rel="1" seriesName="Goal" data:realIndex="0"><path id="SvgjsPath1782" d="M 42.80792922973632 198.489 L 42.80792922973632 17.57509999999999 L 87.71298446655273 17.57509999999999 L 87.71298446655273 198.489 Z" fill="rgba(64,81,137,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectBarMask8dfude08)" pathTo="M 42.80792922973632 198.489 L 42.80792922973632 17.57509999999999 L 87.71298446655273 17.57509999999999 L 87.71298446655273 198.489 Z" pathFrom="M 42.80792922973632 198.489 L 42.80792922973632 198.489 L 87.71298446655273 198.489 L 87.71298446655273 198.489 L 87.71298446655273 198.489 L 87.71298446655273 198.489 L 87.71298446655273 198.489 L 42.80792922973632 198.489 Z" cy="15.074099999999987" cx="268.1389533996582" j="0" val="37" barHeight="185.9139" barWidth="49.90505523681641"></path><g id="SvgjsG1779" class="apexcharts-bar-goals-markers"><g id="SvgjsG1781" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMask8dfude08)"></g></g><g id="SvgjsG1780" class="apexcharts-bar-shadows apexcharts-hidden-element-shown"></g></g><g id="SvgjsG1787" class="apexcharts-series" rel="2" seriesName="PendingxForcast" data:realIndex="1"><path id="SvgjsPath1792" d="M 92.71298446655273 198.489 L 92.71298446655273 143.1926 L 137.61803970336913 143.1926 L 137.61803970336913 198.489 Z" fill="rgba(10,179,156,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectBarMask8dfude08)" pathTo="M 92.71298446655273 198.489 L 92.71298446655273 143.1926 L 137.61803970336913 143.1926 L 137.61803970336913 198.489 Z" pathFrom="M 92.71298446655273 198.489 L 92.71298446655273 198.489 L 137.61803970336913 198.489 L 137.61803970336913 198.489 L 137.61803970336913 198.489 L 137.61803970336913 198.489 L 137.61803970336913 198.489 L 92.71298446655273 198.489 Z" cy="140.6916" cx="318.0440086364746" j="0" val="12" barHeight="60.2964" barWidth="49.90505523681641"></path><g id="SvgjsG1789" class="apexcharts-bar-goals-markers"><g id="SvgjsG1791" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMask8dfude08)"></g></g><g id="SvgjsG1790" class="apexcharts-bar-shadows apexcharts-hidden-element-shown"></g></g><g id="SvgjsG1797" class="apexcharts-series" rel="3" seriesName="Revenue" data:realIndex="2"><path id="SvgjsPath1802" d="M 142.61803970336913 198.489 L 142.61803970336913 113.04440000000001 L 187.52309494018556 113.04440000000001 L 187.52309494018556 198.489 Z" fill="rgba(247,184,75,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectBarMask8dfude08)" pathTo="M 142.61803970336913 198.489 L 142.61803970336913 113.04440000000001 L 187.52309494018556 113.04440000000001 L 187.52309494018556 198.489 Z" pathFrom="M 142.61803970336913 198.489 L 142.61803970336913 198.489 L 187.52309494018556 198.489 L 187.52309494018556 198.489 L 187.52309494018556 198.489 L 187.52309494018556 198.489 L 187.52309494018556 198.489 L 142.61803970336913 198.489 Z" cy="110.5434" cx="367.94906387329104" j="0" val="18" barHeight="90.4446" barWidth="49.90505523681641"></path><g id="SvgjsG1799" class="apexcharts-bar-goals-markers"><g id="SvgjsG1801" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMask8dfude08)"></g></g><g id="SvgjsG1800" class="apexcharts-bar-shadows apexcharts-hidden-element-shown"></g></g><g id="SvgjsG1778" class="apexcharts-datalabels apexcharts-hidden-element-shown" data:realIndex="0"><g id="SvgjsG1784" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText1786" font-family="Helvetica, Arial, sans-serif" x="62.76045684814452" y="116.53105" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-datalabel" cx="62.76045684814452" cy="116.53105" style="font-family: Helvetica, Arial, sans-serif;">37</text></g></g><g id="SvgjsG1788" class="apexcharts-datalabels apexcharts-hidden-element-shown" data:realIndex="1"><g id="SvgjsG1794" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText1796" font-family="Helvetica, Arial, sans-serif" x="112.66551208496091" y="179.3398" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-datalabel" cx="112.66551208496091" cy="179.3398" style="font-family: Helvetica, Arial, sans-serif;">12</text></g></g><g id="SvgjsG1798" class="apexcharts-datalabels apexcharts-hidden-element-shown" data:realIndex="2"><g id="SvgjsG1804" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText1806" font-family="Helvetica, Arial, sans-serif" x="162.57056732177736" y="164.2657" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-datalabel" cx="162.57056732177736" cy="164.2657" style="font-family: Helvetica, Arial, sans-serif;">18</text></g></g></g><line id="SvgjsLine1818" x1="0" y1="0" x2="230.33102416992188" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1819" x1="0" y1="0" x2="230.33102416992188" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1820" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1821" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1823" font-family="Helvetica, Arial, sans-serif" x="115.16551208496094" y="228.988" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1824"></tspan><title></title></text></g><g id="SvgjsG1825" class="apexcharts-xaxis-title"><text id="SvgjsText1826" font-family="Helvetica, Arial, sans-serif" x="115.16551208496094" y="231" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#78909c" class="apexcharts-text apexcharts-xaxis-title-text " style="font-family: Helvetica, Arial, sans-serif;">Total Forecasted Value</text></g></g><g id="SvgjsG1845" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1846" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1847" class="apexcharts-point-annotations"></g></g></svg><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-0" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(64, 81, 137);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-1" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(10, 179, 156);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-2" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(247, 184, 75);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xxl-3 col-md-6">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="mb-0 card-title flex-grow-1">Deal Type</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Monthly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Weekly</a>
                                    <a class="dropdown-item" href="#">Monthly</a>
                                    <a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="pb-0 card-body">
                        <div id="deal-type-charts" data-colors="[&quot;--vz-warning&quot;, &quot;--vz-danger&quot;, &quot;--vz-success&quot;]" data-colors-minimal="[&quot;--vz-primary-rgb, 0.15&quot;, &quot;--vz-primary-rgb, 0.35&quot;, &quot;--vz-primary-rgb, 0.45&quot;]" data-colors-modern="[&quot;--vz-warning&quot;, &quot;--vz-secondary&quot;, &quot;--vz-success&quot;]" data-colors-interactive="[&quot;--vz-warning&quot;, &quot;--vz-info&quot;, &quot;--vz-primary&quot;]" data-colors-corporate="[&quot;--vz-secondary&quot;, &quot;--vz-info&quot;, &quot;--vz-success&quot;]" data-colors-classic="[&quot;--vz-secondary&quot;, &quot;--vz-danger&quot;, &quot;--vz-success&quot;]" class="apex-charts" dir="ltr" style="min-height: 356px;"><div id="apexchartshizo03c9" class="apexcharts-canvas apexchartshizo03c9 apexcharts-theme-" style="width: 294px; height: 341px;"><svg id="SvgjsSvg1848" width="294" height="341" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"><foreignObject x="0" y="0" width="294" height="341"><div xmlns="http://www.w3.org/1999/xhtml" style="position: relative; height: 100%; width: 100%;"><div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom" style="right: 0px; position: absolute; left: 20px; top: 308px; max-height: 170.5px;"><div class="apexcharts-legend-series" rel="1" seriesname="Pending" data:collapsed="false" style="margin: 0px 10px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="height: 16px; width: 16px; left: 0px; top: 0px;"><svg id="SvgjsSvg1851" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"><defs id="SvgjsDefs1852"><clipPath id="gridRectMaskhizo03c9"><rect id="SvgjsRect1862" width="281.4609375" height="286" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectBarMaskhizo03c9"><rect id="SvgjsRect1863" width="287.4609375" height="292" x="-3" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskhizo03c9"><rect id="SvgjsRect1864" width="281.4609375" height="286" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskhizo03c9"></clipPath><clipPath id="nonForecastMaskhizo03c9"></clipPath></defs><path id="SvgjsPath1853" d="M 0, 0
m -7, 0
a 7,7 0 1,0 14,0
a 7,7 0 1,0 -14,0" fill="#f7b84b" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle" style="transform: translate(50%, 50%);"></path></svg></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="Pending" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 500; font-family: Helvetica, Arial, sans-serif;">Pending</span></div><div class="apexcharts-legend-series" rel="2" seriesname="Loss" data:collapsed="false" style="margin: 0px 10px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="height: 16px; width: 16px; left: 0px; top: 0px;"><svg id="SvgjsSvg1854" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"><defs id="SvgjsDefs1855"></defs><path id="SvgjsPath1856" d="M 0, 0
m -7, 0
a 7,7 0 1,0 14,0
a 7,7 0 1,0 -14,0" fill="#f06548" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle" style="transform: translate(50%, 50%);"></path></svg></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="Loss" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 500; font-family: Helvetica, Arial, sans-serif;">Loss</span></div><div class="apexcharts-legend-series" rel="3" seriesname="Won" data:collapsed="false" style="margin: 0px 10px;"><span class="apexcharts-legend-marker" rel="3" data:collapsed="false" style="height: 16px; width: 16px; left: 0px; top: 0px;"><svg id="SvgjsSvg1857" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"><defs id="SvgjsDefs1858"></defs><path id="SvgjsPath1859" d="M 0, 0
m -7, 0
a 7,7 0 1,0 14,0
a 7,7 0 1,0 -14,0" fill="#0ab39c" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle" style="transform: translate(50%, 50%);"></path></svg></span><span class="apexcharts-legend-text" rel="3" i="2" data:default-text="Won" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 500; font-family: Helvetica, Arial, sans-serif;">Won</span></div></div></div><style type="text/css">
.apexcharts-legend {
display: flex;
overflow: auto;
padding: 0 10px;
}
.apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
flex-wrap: wrap
}
.apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
flex-direction: column;
bottom: 0;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
justify-content: flex-start;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
justify-content: center;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
justify-content: flex-end;
}
.apexcharts-legend-series {
cursor: pointer;
line-height: normal;
display: flex;
align-items: center;
}
.apexcharts-legend-text {
position: relative;
font-size: 14px;
}
.apexcharts-legend-text *, .apexcharts-legend-marker * {
pointer-events: none;
}
.apexcharts-legend-marker {
position: relative;
display: flex;
align-items: center;
justify-content: center;
cursor: pointer;
margin-right: 1px;
}

.apexcharts-legend-series.apexcharts-no-click {
cursor: auto;
}
.apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
display: none !important;
}
.apexcharts-inactive-legend {
opacity: 0.45;
}</style></foreignObject><g id="SvgjsG1850" class="apexcharts-inner apexcharts-graphical" transform="translate(2, 30)"><defs id="SvgjsDefs1849"><filter id="SvgjsFilter1874" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1875" flood-color="#000000" flood-opacity="0.35" result="SvgjsFeFlood1875Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1876" in="SvgjsFeFlood1875Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1876Out"></feComposite><feOffset id="SvgjsFeOffset1877" dx="1" dy="1" result="SvgjsFeOffset1877Out" in="SvgjsFeComposite1876Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1878" stdDeviation="1 " result="SvgjsFeGaussianBlur1878Out" in="SvgjsFeOffset1877Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1879" result="SvgjsFeMerge1879Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1880" in="SvgjsFeGaussianBlur1878Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1881" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1882" in="SourceGraphic" in2="SvgjsFeMerge1879Out" mode="normal" result="SvgjsFeBlend1882Out"></feBlend></filter><filter id="SvgjsFilter1900" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1901" flood-color="#000000" flood-opacity="0.35" result="SvgjsFeFlood1901Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1902" in="SvgjsFeFlood1901Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1902Out"></feComposite><feOffset id="SvgjsFeOffset1903" dx="1" dy="1" result="SvgjsFeOffset1903Out" in="SvgjsFeComposite1902Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1904" stdDeviation="1 " result="SvgjsFeGaussianBlur1904Out" in="SvgjsFeOffset1903Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1905" result="SvgjsFeMerge1905Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1906" in="SvgjsFeGaussianBlur1904Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1907" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1908" in="SourceGraphic" in2="SvgjsFeMerge1905Out" mode="normal" result="SvgjsFeBlend1908Out"></feBlend></filter><filter id="SvgjsFilter1926" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1927" flood-color="#000000" flood-opacity="0.35" result="SvgjsFeFlood1927Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1928" in="SvgjsFeFlood1927Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1928Out"></feComposite><feOffset id="SvgjsFeOffset1929" dx="1" dy="1" result="SvgjsFeOffset1929Out" in="SvgjsFeComposite1928Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1930" stdDeviation="1 " result="SvgjsFeGaussianBlur1930Out" in="SvgjsFeOffset1929Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1931" result="SvgjsFeMerge1931Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1932" in="SvgjsFeGaussianBlur1930Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1933" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1934" in="SourceGraphic" in2="SvgjsFeMerge1931Out" mode="normal" result="SvgjsFeBlend1934Out"></feBlend></filter></defs><g id="SvgjsG1972" class="apexcharts-grid"><g id="SvgjsG1973" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1976" x1="0" y1="0" x2="281.4609375" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1977" x1="0" y1="57.2" x2="281.4609375" y2="57.2" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1978" x1="0" y1="114.4" x2="281.4609375" y2="114.4" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1979" x1="0" y1="171.60000000000002" x2="281.4609375" y2="171.60000000000002" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1980" x1="0" y1="228.8" x2="281.4609375" y2="228.8" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1981" x1="0" y1="286" x2="281.4609375" y2="286" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1974" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1983" x1="0" y1="286" x2="281.4609375" y2="286" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1982" x1="0" y1="1" x2="0" y2="286" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1975" class="apexcharts-grid-borders" style="display: none;"></g><g id="SvgjsG1867" class="apexcharts-radar-series apexcharts-plot-series" transform="translate(140.73046875, 143)"><polygon id="SvgjsPolygon1953" points="0,-117.84151785714286 102.05374808480327,-58.920758928571445 102.05374808480329,58.9207589285714 1.4431423765041566e-14,117.84151785714286 -102.05374808480325,58.92075892857148 -102.05374808480333,-58.92075892857135 " fill="none" stroke="#e8e8e8" stroke-width="1"></polygon><polygon id="SvgjsPolygon1954" points="0,-94.27321428571429 81.64299846784262,-47.13660714285715 81.64299846784263,47.13660714285712 1.1545139012033254e-14,94.27321428571429 -81.6429984678426,47.13660714285719 -81.64299846784266,-47.13660714285708 " fill="none" stroke="#e8e8e8" stroke-width="1"></polygon><polygon id="SvgjsPolygon1955" points="0,-70.70491071428572 61.232248850881966,-35.352455357142865 61.23224885088197,35.352455357142844 8.65885425902494e-15,70.70491071428572 -61.23224885088195,35.35245535714289 -61.232248850882,-35.35245535714281 " fill="none" stroke="#e8e8e8" stroke-width="1"></polygon><polygon id="SvgjsPolygon1956" points="0,-47.136607142857144 40.82149923392131,-23.568303571428576 40.821499233921315,23.56830357142856 5.772569506016627e-15,47.136607142857144 -40.8214992339213,23.568303571428594 -40.82149923392133,-23.56830357142854 " fill="none" stroke="#e8e8e8" stroke-width="1"></polygon><polygon id="SvgjsPolygon1957" points="0,-23.568303571428572 20.410749616960654,-11.784151785714288 20.410749616960658,11.78415178571428 2.8862847530083135e-15,23.568303571428572 -20.41074961696065,11.784151785714297 -20.410749616960665,-11.78415178571427 " fill="none" stroke="#e8e8e8" stroke-width="1"></polygon><polygon id="SvgjsPolygon1958" points="0,0 0,0 0,0 0,0 0,0 0,0 " fill="none" stroke="#e8e8e8" stroke-width="1"></polygon><line id="SvgjsLine1947" x1="0" y1="-117.84151785714286" x2="0" y2="0" stroke="#e8e8e8" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1948" x1="102.05374808480327" y1="-58.920758928571445" x2="0" y2="0" stroke="#e8e8e8" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1949" x1="102.05374808480329" y1="58.9207589285714" x2="0" y2="0" stroke="#e8e8e8" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1950" x1="1.4431423765041566e-14" y1="117.84151785714286" x2="0" y2="0" stroke="#e8e8e8" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1951" x1="-102.05374808480325" y1="58.92075892857148" x2="0" y2="0" stroke="#e8e8e8" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1952" x1="-102.05374808480333" y1="-58.92075892857135" x2="0" y2="0" stroke="#e8e8e8" stroke-dasharray="0" stroke-linecap="butt"></line><g id="SvgjsG1965" class="apexcharts-xaxis"><text id="SvgjsText1966" font-family="Helvetica, Arial, sans-serif" x="0" y="-127.84151785714286" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#a8a8a8" class="apexcharts-xaxis-label" cx="0" cy="-127.84151785714286" style="font-family: Helvetica, Arial, sans-serif;">2016</text><text id="SvgjsText1967" font-family="Helvetica, Arial, sans-serif" x="112.05374808480327" y="-58.920758928571445" text-anchor="start" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#a8a8a8" class="apexcharts-xaxis-label" cx="112.05374808480327" cy="-58.920758928571445" style="font-family: Helvetica, Arial, sans-serif;">2017</text><text id="SvgjsText1968" font-family="Helvetica, Arial, sans-serif" x="112.05374808480329" y="58.9207589285714" text-anchor="start" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#a8a8a8" class="apexcharts-xaxis-label" cx="112.05374808480329" cy="58.9207589285714" style="font-family: Helvetica, Arial, sans-serif;">2018</text><text id="SvgjsText1969" font-family="Helvetica, Arial, sans-serif" x="1.4431423765041566e-14" y="127.84151785714286" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#a8a8a8" class="apexcharts-xaxis-label" cx="1.4431423765041566e-14" cy="127.84151785714286" style="font-family: Helvetica, Arial, sans-serif;">2019</text><text id="SvgjsText1970" font-family="Helvetica, Arial, sans-serif" x="-112.05374808480325" y="58.92075892857148" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#a8a8a8" class="apexcharts-xaxis-label" cx="-112.05374808480325" cy="58.92075892857148" style="font-family: Helvetica, Arial, sans-serif;">2020</text><text id="SvgjsText1971" font-family="Helvetica, Arial, sans-serif" x="-112.05374808480333" y="-58.92075892857135" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#a8a8a8" class="apexcharts-xaxis-label" cx="-112.05374808480333" cy="-58.92075892857135" style="font-family: Helvetica, Arial, sans-serif;">2021</text></g><g id="SvgjsG1869" class="apexcharts-series" data:longestSeries="true" seriesName="Pending" rel="1" data:realIndex="0"><path id="SvgjsPath1872" d="M 0 -94.27321428571429 L 0 -94.27321428571429 L 51.02687404240164 -29.460379464285722 L 30.616124425440987 17.676227678571422 L 5.772569506016627e-15 47.136607142857144 L -102.05374808480325 58.92075892857148 L -20.410749616960665 -11.78415178571427Z" fill="none" fill-opacity="1" stroke="#f7b84b" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-radar" index="0" pathTo="M 0 -94.27321428571429 L 0 -94.27321428571429 L 51.02687404240164 -29.460379464285722 L 30.616124425440987 17.676227678571422 L 5.772569506016627e-15 47.136607142857144 L -102.05374808480325 58.92075892857148 L -20.410749616960665 -11.78415178571427Z" pathFrom="M 0 0"></path><path id="SvgjsPath1873" d="M 0 -94.27321428571429 L 0 -94.27321428571429 L 51.02687404240164 -29.460379464285722 L 30.616124425440987 17.676227678571422 L 5.772569506016627e-15 47.136607142857144 L -102.05374808480325 58.92075892857148 L -20.410749616960665 -11.78415178571427Z" fill="rgba(247,184,75,0.2)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-radar" index="0" pathTo="M 0 -94.27321428571429 L 0 -94.27321428571429 L 51.02687404240164 -29.460379464285722 L 30.616124425440987 17.676227678571422 L 5.772569506016627e-15 47.136607142857144 L -102.05374808480325 58.92075892857148 L -20.410749616960665 -11.78415178571427Z" pathFrom="M 0 0" filter="url(#SvgjsFilter1874)"></path><g id="SvgjsG1870" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"><g id="SvgjsG1884" class="apexcharts-series-markers"><path id="SvgjsPath1883" d="M 0, -94.27321428571429
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f7b84b" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="0" cy="-94.27321428571429" shape="circle" class="apexcharts-marker" rel="0" j="0" index="0" default-marker-size="0"></path></g><g id="SvgjsG1886" class="apexcharts-series-markers"><path id="SvgjsPath1885" d="M 51.02687404240164, -29.460379464285722
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f7b84b" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="51.02687404240164" cy="-29.460379464285722" shape="circle" class="apexcharts-marker" rel="1" j="1" index="0" default-marker-size="0"></path></g><g id="SvgjsG1888" class="apexcharts-series-markers"><path id="SvgjsPath1887" d="M 30.616124425440987, 17.676227678571422
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f7b84b" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="30.616124425440987" cy="17.676227678571422" shape="circle" class="apexcharts-marker" rel="2" j="2" index="0" default-marker-size="0"></path></g><g id="SvgjsG1890" class="apexcharts-series-markers"><path id="SvgjsPath1889" d="M 5.772569506016627e-15, 47.136607142857144
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f7b84b" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="5.772569506016627e-15" cy="47.136607142857144" shape="circle" class="apexcharts-marker" rel="3" j="3" index="0" default-marker-size="0"></path></g><g id="SvgjsG1892" class="apexcharts-series-markers"><path id="SvgjsPath1891" d="M -102.05374808480325, 58.92075892857148
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f7b84b" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="-102.05374808480325" cy="58.92075892857148" shape="circle" class="apexcharts-marker" rel="4" j="4" index="0" default-marker-size="0"></path></g><g id="SvgjsG1894" class="apexcharts-series-markers"><path id="SvgjsPath1893" d="M -20.410749616960665, -11.78415178571427
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f7b84b" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="-20.410749616960665" cy="-11.78415178571427" shape="circle" class="apexcharts-marker" rel="5" j="5" index="0" default-marker-size="0"></path></g><g class="apexcharts-series-markers"><path id="SvgjsPath1989" d="M 0, 0
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f7b84b" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-marker wzp8mwjfx" default-marker-size="0"></path></g></g></g><g id="SvgjsG1895" class="apexcharts-series" data:longestSeries="true" seriesName="Loss" rel="2" data:realIndex="1"><path id="SvgjsPath1898" d="M 0 -23.568303571428572 L 0 -23.568303571428572 L 30.616124425440983 -17.676227678571433 L 40.821499233921315 23.56830357142856 L 1.1545139012033254e-14 94.27321428571429 L -20.41074961696065 11.784151785714297 L -81.64299846784266 -47.13660714285708Z" fill="none" fill-opacity="1" stroke="#f06548" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-radar" index="1" pathTo="M 0 -23.568303571428572 L 0 -23.568303571428572 L 30.616124425440983 -17.676227678571433 L 40.821499233921315 23.56830357142856 L 1.1545139012033254e-14 94.27321428571429 L -20.41074961696065 11.784151785714297 L -81.64299846784266 -47.13660714285708Z" pathFrom="M 0 0"></path><path id="SvgjsPath1899" d="M 0 -23.568303571428572 L 0 -23.568303571428572 L 30.616124425440983 -17.676227678571433 L 40.821499233921315 23.56830357142856 L 1.1545139012033254e-14 94.27321428571429 L -20.41074961696065 11.784151785714297 L -81.64299846784266 -47.13660714285708Z" fill="rgba(240,101,72,0.2)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-radar" index="1" pathTo="M 0 -23.568303571428572 L 0 -23.568303571428572 L 30.616124425440983 -17.676227678571433 L 40.821499233921315 23.56830357142856 L 1.1545139012033254e-14 94.27321428571429 L -20.41074961696065 11.784151785714297 L -81.64299846784266 -47.13660714285708Z" pathFrom="M 0 0" filter="url(#SvgjsFilter1900)"></path><g id="SvgjsG1896" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"><g id="SvgjsG1910" class="apexcharts-series-markers"><path id="SvgjsPath1909" d="M 0, -23.568303571428572
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f06548" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="0" cy="-23.568303571428572" shape="circle" class="apexcharts-marker" rel="0" j="0" index="1" default-marker-size="0"></path></g><g id="SvgjsG1912" class="apexcharts-series-markers"><path id="SvgjsPath1911" d="M 30.616124425440983, -17.676227678571433
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f06548" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="30.616124425440983" cy="-17.676227678571433" shape="circle" class="apexcharts-marker" rel="1" j="1" index="1" default-marker-size="0"></path></g><g id="SvgjsG1914" class="apexcharts-series-markers"><path id="SvgjsPath1913" d="M 40.821499233921315, 23.56830357142856
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f06548" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="40.821499233921315" cy="23.56830357142856" shape="circle" class="apexcharts-marker" rel="2" j="2" index="1" default-marker-size="0"></path></g><g id="SvgjsG1916" class="apexcharts-series-markers"><path id="SvgjsPath1915" d="M 1.1545139012033254e-14, 94.27321428571429
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f06548" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="1.1545139012033254e-14" cy="94.27321428571429" shape="circle" class="apexcharts-marker" rel="3" j="3" index="1" default-marker-size="0"></path></g><g id="SvgjsG1918" class="apexcharts-series-markers"><path id="SvgjsPath1917" d="M -20.41074961696065, 11.784151785714297
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f06548" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="-20.41074961696065" cy="11.784151785714297" shape="circle" class="apexcharts-marker" rel="4" j="4" index="1" default-marker-size="0"></path></g><g id="SvgjsG1920" class="apexcharts-series-markers"><path id="SvgjsPath1919" d="M -81.64299846784266, -47.13660714285708
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f06548" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="-81.64299846784266" cy="-47.13660714285708" shape="circle" class="apexcharts-marker" rel="5" j="5" index="1" default-marker-size="0"></path></g><g class="apexcharts-series-markers"><path id="SvgjsPath1990" d="M 0, 0
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f7b84b" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-marker whjuviipv" default-marker-size="0"></path></g></g></g><g id="SvgjsG1921" class="apexcharts-series" data:longestSeries="true" seriesName="Won" rel="3" data:realIndex="2"><path id="SvgjsPath1924" d="M 0 -51.85026785714286 L 0 -51.85026785714286 L 77.5608485444505 -44.7797767857143 L 79.60192350614656 45.958191964285696 L 1.8760850894554037e-15 15.319397321428573 L -43.8831116764654 25.335926339285734 L -10.205374808480332 -5.892075892857135Z" fill="none" fill-opacity="1" stroke="#0ab39c" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-radar" index="2" pathTo="M 0 -51.85026785714286 L 0 -51.85026785714286 L 77.5608485444505 -44.7797767857143 L 79.60192350614656 45.958191964285696 L 1.8760850894554037e-15 15.319397321428573 L -43.8831116764654 25.335926339285734 L -10.205374808480332 -5.892075892857135Z" pathFrom="M 0 0"></path><path id="SvgjsPath1925" d="M 0 -51.85026785714286 L 0 -51.85026785714286 L 77.5608485444505 -44.7797767857143 L 79.60192350614656 45.958191964285696 L 1.8760850894554037e-15 15.319397321428573 L -43.8831116764654 25.335926339285734 L -10.205374808480332 -5.892075892857135Z" fill="rgba(10,179,156,0.2)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-radar" index="2" pathTo="M 0 -51.85026785714286 L 0 -51.85026785714286 L 77.5608485444505 -44.7797767857143 L 79.60192350614656 45.958191964285696 L 1.8760850894554037e-15 15.319397321428573 L -43.8831116764654 25.335926339285734 L -10.205374808480332 -5.892075892857135Z" pathFrom="M 0 0" filter="url(#SvgjsFilter1926)"></path><g id="SvgjsG1922" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"><g id="SvgjsG1936" class="apexcharts-series-markers"><path id="SvgjsPath1935" d="M 0, -51.85026785714286
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#0ab39c" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="0" cy="-51.85026785714286" shape="circle" class="apexcharts-marker" rel="0" j="0" index="2" default-marker-size="0"></path></g><g id="SvgjsG1938" class="apexcharts-series-markers"><path id="SvgjsPath1937" d="M 77.5608485444505, -44.7797767857143
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#0ab39c" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="77.5608485444505" cy="-44.7797767857143" shape="circle" class="apexcharts-marker" rel="1" j="1" index="2" default-marker-size="0"></path></g><g id="SvgjsG1940" class="apexcharts-series-markers"><path id="SvgjsPath1939" d="M 79.60192350614656, 45.958191964285696
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#0ab39c" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="79.60192350614656" cy="45.958191964285696" shape="circle" class="apexcharts-marker" rel="2" j="2" index="2" default-marker-size="0"></path></g><g id="SvgjsG1942" class="apexcharts-series-markers"><path id="SvgjsPath1941" d="M 1.8760850894554037e-15, 15.319397321428573
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#0ab39c" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="1.8760850894554037e-15" cy="15.319397321428573" shape="circle" class="apexcharts-marker" rel="3" j="3" index="2" default-marker-size="0"></path></g><g id="SvgjsG1944" class="apexcharts-series-markers"><path id="SvgjsPath1943" d="M -43.8831116764654, 25.335926339285734
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#0ab39c" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="-43.8831116764654" cy="25.335926339285734" shape="circle" class="apexcharts-marker" rel="4" j="4" index="2" default-marker-size="0"></path></g><g id="SvgjsG1946" class="apexcharts-series-markers"><path id="SvgjsPath1945" d="M -10.205374808480332, -5.892075892857135
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#0ab39c" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="-10.205374808480332" cy="-5.892075892857135" shape="circle" class="apexcharts-marker" rel="5" j="5" index="2" default-marker-size="0"></path></g><g class="apexcharts-series-markers"><path id="SvgjsPath1991" d="M 0, 0
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f7b84b" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-marker wtmt7gm5c" default-marker-size="0"></path></g></g></g><g id="SvgjsG1868" class="apexcharts-yaxis"><text id="SvgjsText1959" font-family="Helvetica, Arial, sans-serif" x="0" y="-111.84151785714286" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-text " style="font-family: Helvetica, Arial, sans-serif;">100</text><text id="SvgjsText1960" font-family="Helvetica, Arial, sans-serif" x="0" y="-88.27321428571429" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-text " style="font-family: Helvetica, Arial, sans-serif;">80</text><text id="SvgjsText1961" font-family="Helvetica, Arial, sans-serif" x="0" y="-64.70491071428572" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-text " style="font-family: Helvetica, Arial, sans-serif;">60</text><text id="SvgjsText1962" font-family="Helvetica, Arial, sans-serif" x="0" y="-41.136607142857144" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-text " style="font-family: Helvetica, Arial, sans-serif;">40</text><text id="SvgjsText1963" font-family="Helvetica, Arial, sans-serif" x="0" y="-17.568303571428572" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-text " style="font-family: Helvetica, Arial, sans-serif;">20</text><text id="SvgjsText1964" font-family="Helvetica, Arial, sans-serif" x="0" y="6" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-text " style="font-family: Helvetica, Arial, sans-serif;">0</text></g><g id="SvgjsG1871" class="apexcharts-datalabels" data:realIndex="0"></g><g id="SvgjsG1897" class="apexcharts-datalabels" data:realIndex="1"></g><g id="SvgjsG1923" class="apexcharts-datalabels" data:realIndex="2"></g></g><line id="SvgjsLine1984" x1="0" y1="0" x2="281.4609375" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1985" x1="0" y1="0" x2="281.4609375" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1986" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1987" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1988" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1865" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g><g id="SvgjsG1866" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g></svg><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-0" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(247, 184, 75);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-1" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(240, 101, 72);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-2" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(10, 179, 156);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xxl-6">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="mb-0 card-title flex-grow-1">Balance Overview</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Current Year<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Last Week</a>
                                    <a class="dropdown-item" href="#">Last Month</a>
                                    <a class="dropdown-item" href="#">Current Year</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="px-0 card-body">
                        <ul class="mb-0 text-center list-inline main-chart">
                            <li class="border-0 list-inline-item chart-border-left me-0">
                                <h4 class="text-primary">$584k <span class="align-middle text-muted d-inline-block fs-13 ms-2">Revenue</span></h4>
                            </li>
                            <li class="list-inline-item chart-border-left me-0">
                                <h4>$497k<span class="align-middle text-muted d-inline-block fs-13 ms-2">Expenses</span>
                                </h4>
                            </li>
                            <li class="list-inline-item chart-border-left me-0">
                                <h4><span data-plugin="counterup">3.6</span>%<span class="align-middle text-muted d-inline-block fs-13 ms-2">Profit Ratio</span></h4>
                            </li>
                        </ul>

                        <div id="revenue-expenses-charts" data-colors="[&quot;--vz-success&quot;, &quot;--vz-danger&quot;]" data-colors-minimal="[&quot;--vz-primary&quot;, &quot;--vz-info&quot;]" data-colors-interactive="[&quot;--vz-info&quot;, &quot;--vz-primary&quot;]" data-colors-galaxy="[&quot;--vz-primary&quot;, &quot;--vz-secondary&quot;]" data-colors-classic="[&quot;--vz-primary&quot;, &quot;--vz-secondary&quot;]" class="apex-charts" dir="ltr" style="min-height: 305px;"><div id="apexchartsnz46j2mr" class="apexcharts-canvas apexchartsnz46j2mr apexcharts-theme-" style="width: 676px; height: 290px;"><svg id="SvgjsSvg1992" width="676" height="290" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS" transform="translate(0, 0)"><foreignObject x="0" y="0" width="676" height="290"><div xmlns="http://www.w3.org/1999/xhtml" style="position: relative; height: 100%; width: 100%;"><div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom" style="right: 0px; position: absolute; left: 0px; top: 261px; max-height: 145px;"><div class="apexcharts-legend-series" rel="1" seriesname="Revenue" data:collapsed="false" style="margin: 4px 5px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="height: 16px; width: 16px; left: 0px; top: 0px;"><svg id="SvgjsSvg1995" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"><defs id="SvgjsDefs1996"><clipPath id="gridRectMasknz46j2mr"><rect id="SvgjsRect2005" width="592.9780426025391" height="189.494" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectBarMasknz46j2mr"><rect id="SvgjsRect2006" width="598.9780426025391" height="195.494" x="-3" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMasknz46j2mr"><rect id="SvgjsRect2007" width="592.9780426025391" height="189.494" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMasknz46j2mr"></clipPath><clipPath id="nonForecastMasknz46j2mr"></clipPath></defs><path id="SvgjsPath1997" d="M 0, 0
m -7, 0
a 7,7 0 1,0 14,0
a 7,7 0 1,0 -14,0" fill="#0ab39c" fill-opacity="1" stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle" style="transform: translate(50%, 50%);"></path></svg></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="Revenue" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Revenue</span></div><div class="apexcharts-legend-series" rel="2" seriesname="Expenses" data:collapsed="false" style="margin: 4px 5px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="height: 16px; width: 16px; left: 0px; top: 0px;"><svg id="SvgjsSvg1998" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"><defs id="SvgjsDefs1999"></defs><path id="SvgjsPath2000" d="M 0, 0
m -7, 0
a 7,7 0 1,0 14,0
a 7,7 0 1,0 -14,0" fill="#f06548" fill-opacity="1" stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="butt" stroke-width="1" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle" style="transform: translate(50%, 50%);"></path></svg></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="Expenses" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Expenses</span></div></div></div><style type="text/css">
.apexcharts-legend {
display: flex;
overflow: auto;
padding: 0 10px;
}
.apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
flex-wrap: wrap
}
.apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
flex-direction: column;
bottom: 0;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
justify-content: flex-start;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
justify-content: center;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
justify-content: flex-end;
}
.apexcharts-legend-series {
cursor: pointer;
line-height: normal;
display: flex;
align-items: center;
}
.apexcharts-legend-text {
position: relative;
font-size: 14px;
}
.apexcharts-legend-text *, .apexcharts-legend-marker * {
pointer-events: none;
}
.apexcharts-legend-marker {
position: relative;
display: flex;
align-items: center;
justify-content: center;
cursor: pointer;
margin-right: 1px;
}

.apexcharts-legend-series.apexcharts-no-click {
cursor: auto;
}
.apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
display: none !important;
}
.apexcharts-inactive-legend {
opacity: 0.45;
}</style></foreignObject><rect id="SvgjsRect2003" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG2008" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g><g id="SvgjsG2009" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g><g id="SvgjsG2086" class="apexcharts-yaxis" rel="0" transform="translate(30.059967041015625, 0)"><g id="SvgjsG2087" class="apexcharts-yaxis-texts-g"><text id="SvgjsText2089" font-family="Helvetica, Arial, sans-serif" x="20" y="33.666666666666664" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2090">$260k</tspan><title>$260k</title></text><text id="SvgjsText2092" font-family="Helvetica, Arial, sans-serif" x="20" y="71.56546666666667" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2093">$208k</tspan><title>$208k</title></text><text id="SvgjsText2095" font-family="Helvetica, Arial, sans-serif" x="20" y="109.46426666666667" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2096">$156k</tspan><title>$156k</title></text><text id="SvgjsText2098" font-family="Helvetica, Arial, sans-serif" x="20" y="147.36306666666667" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2099">$104k</tspan><title>$104k</title></text><text id="SvgjsText2101" font-family="Helvetica, Arial, sans-serif" x="20" y="185.26186666666666" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2102">$52k</tspan><title>$52k</title></text><text id="SvgjsText2104" font-family="Helvetica, Arial, sans-serif" x="20" y="223.16066666666666" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2105">$0k</tspan><title>$0k</title></text></g></g><g id="SvgjsG1994" class="apexcharts-inner apexcharts-graphical" transform="translate(60.059967041015625, 30)"><defs id="SvgjsDefs1993"></defs><line id="SvgjsLine2004" x1="0" y1="0" x2="0" y2="189.494" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="189.494" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><line id="SvgjsLine2025" x1="0" y1="189.494" x2="0" y2="195.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2026" x1="53.90709478204901" y1="189.494" x2="53.90709478204901" y2="195.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2027" x1="107.81418956409802" y1="189.494" x2="107.81418956409802" y2="195.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2028" x1="161.72128434614703" y1="189.494" x2="161.72128434614703" y2="195.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2029" x1="215.62837912819603" y1="189.494" x2="215.62837912819603" y2="195.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2030" x1="269.53547391024506" y1="189.494" x2="269.53547391024506" y2="195.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2031" x1="323.44256869229406" y1="189.494" x2="323.44256869229406" y2="195.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2032" x1="377.34966347434306" y1="189.494" x2="377.34966347434306" y2="195.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2033" x1="431.25675825639206" y1="189.494" x2="431.25675825639206" y2="195.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2034" x1="485.16385303844106" y1="189.494" x2="485.16385303844106" y2="195.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2035" x1="539.0709478204901" y1="189.494" x2="539.0709478204901" y2="195.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2036" x1="592.9780426025392" y1="189.494" x2="592.9780426025392" y2="195.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><g id="SvgjsG2021" class="apexcharts-grid"><g id="SvgjsG2022" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine2038" x1="0" y1="37.8988" x2="592.9780426025391" y2="37.8988" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2039" x1="0" y1="75.7976" x2="592.9780426025391" y2="75.7976" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2040" x1="0" y1="113.69640000000001" x2="592.9780426025391" y2="113.69640000000001" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2041" x1="0" y1="151.5952" x2="592.9780426025391" y2="151.5952" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG2023" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine2044" x1="0" y1="189.494" x2="592.9780426025391" y2="189.494" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine2043" x1="0" y1="1" x2="0" y2="189.494" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG2024" class="apexcharts-grid-borders"><line id="SvgjsLine2037" x1="0" y1="0" x2="592.9780426025391" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2042" x1="0" y1="189.494" x2="592.9780426025391" y2="189.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2085" x1="0" y1="189.494" x2="592.9780426025391" y2="189.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line></g><g id="SvgjsG2010" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG2011" class="apexcharts-series" zIndex="0" seriesName="Revenue" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath2014" d="M 0 174.91753846153847C 18.86748317371715 174.91753846153847 35.03961160833185 171.27342307692308 53.90709478204901 171.27342307692308C 72.77457795576616 171.27342307692308 88.94670639038087 167.6293076923077 107.81418956409802 167.6293076923077C 126.68167273781518 167.6293076923077 142.85380117242988 163.9851923076923 161.72128434614703 163.9851923076923C 180.58876751986418 163.9851923076923 196.76089595447888 160.3410769230769 215.62837912819603 160.3410769230769C 234.49586230191318 160.3410769230769 250.6679907365279 149.40873076923077 269.53547391024506 149.40873076923077C 288.4029570839622 149.40873076923077 304.5750855185769 138.47638461538463 323.44256869229406 138.47638461538463C 342.31005186601124 138.47638461538463 358.48218030062594 109.32346153846154 377.34966347434306 109.32346153846154C 396.2171466480602 109.32346153846154 412.3892750826749 80.17053846153847 431.25675825639206 80.17053846153847C 450.12424143010924 80.17053846153847 466.29636986472394 58.30584615384615 485.16385303844106 58.30584615384615C 504.03133621215824 58.30584615384615 520.203464646773 36.44115384615387 539.0709478204901 36.44115384615387C 557.9384309942072 36.44115384615387 574.110559428822 7.288230769230779 592.9780426025391 7.288230769230779C 592.9780426025391 7.288230769230779 592.9780426025391 7.288230769230779 592.9780426025391 189.494 L 0 189.494z" fill="rgba(10,179,156,0.06)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMasknz46j2mr)" pathTo="M 0 174.91753846153847C 18.86748317371715 174.91753846153847 35.03961160833185 171.27342307692308 53.90709478204901 171.27342307692308C 72.77457795576616 171.27342307692308 88.94670639038087 167.6293076923077 107.81418956409802 167.6293076923077C 126.68167273781518 167.6293076923077 142.85380117242988 163.9851923076923 161.72128434614703 163.9851923076923C 180.58876751986418 163.9851923076923 196.76089595447888 160.3410769230769 215.62837912819603 160.3410769230769C 234.49586230191318 160.3410769230769 250.6679907365279 149.40873076923077 269.53547391024506 149.40873076923077C 288.4029570839622 149.40873076923077 304.5750855185769 138.47638461538463 323.44256869229406 138.47638461538463C 342.31005186601124 138.47638461538463 358.48218030062594 109.32346153846154 377.34966347434306 109.32346153846154C 396.2171466480602 109.32346153846154 412.3892750826749 80.17053846153847 431.25675825639206 80.17053846153847C 450.12424143010924 80.17053846153847 466.29636986472394 58.30584615384615 485.16385303844106 58.30584615384615C 504.03133621215824 58.30584615384615 520.203464646773 36.44115384615387 539.0709478204901 36.44115384615387C 557.9384309942072 36.44115384615387 574.110559428822 7.288230769230779 592.9780426025391 7.288230769230779C 592.9780426025391 7.288230769230779 592.9780426025391 7.288230769230779 592.9780426025391 189.494 L 0 189.494z" pathFrom="M 0 189.494 L 0 189.494 L 53.90709478204901 189.494 L 107.81418956409802 189.494 L 161.72128434614703 189.494 L 215.62837912819603 189.494 L 269.53547391024506 189.494 L 323.44256869229406 189.494 L 377.34966347434306 189.494 L 431.25675825639206 189.494 L 485.16385303844106 189.494 L 539.0709478204901 189.494 L 592.9780426025391 189.494z"></path><path id="SvgjsPath2015" d="M 0 174.91753846153847C 18.86748317371715 174.91753846153847 35.03961160833185 171.27342307692308 53.90709478204901 171.27342307692308C 72.77457795576616 171.27342307692308 88.94670639038087 167.6293076923077 107.81418956409802 167.6293076923077C 126.68167273781518 167.6293076923077 142.85380117242988 163.9851923076923 161.72128434614703 163.9851923076923C 180.58876751986418 163.9851923076923 196.76089595447888 160.3410769230769 215.62837912819603 160.3410769230769C 234.49586230191318 160.3410769230769 250.6679907365279 149.40873076923077 269.53547391024506 149.40873076923077C 288.4029570839622 149.40873076923077 304.5750855185769 138.47638461538463 323.44256869229406 138.47638461538463C 342.31005186601124 138.47638461538463 358.48218030062594 109.32346153846154 377.34966347434306 109.32346153846154C 396.2171466480602 109.32346153846154 412.3892750826749 80.17053846153847 431.25675825639206 80.17053846153847C 450.12424143010924 80.17053846153847 466.29636986472394 58.30584615384615 485.16385303844106 58.30584615384615C 504.03133621215824 58.30584615384615 520.203464646773 36.44115384615387 539.0709478204901 36.44115384615387C 557.9384309942072 36.44115384615387 574.110559428822 7.288230769230779 592.9780426025391 7.288230769230779" fill="none" fill-opacity="1" stroke="#0ab39c" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMasknz46j2mr)" pathTo="M 0 174.91753846153847C 18.86748317371715 174.91753846153847 35.03961160833185 171.27342307692308 53.90709478204901 171.27342307692308C 72.77457795576616 171.27342307692308 88.94670639038087 167.6293076923077 107.81418956409802 167.6293076923077C 126.68167273781518 167.6293076923077 142.85380117242988 163.9851923076923 161.72128434614703 163.9851923076923C 180.58876751986418 163.9851923076923 196.76089595447888 160.3410769230769 215.62837912819603 160.3410769230769C 234.49586230191318 160.3410769230769 250.6679907365279 149.40873076923077 269.53547391024506 149.40873076923077C 288.4029570839622 149.40873076923077 304.5750855185769 138.47638461538463 323.44256869229406 138.47638461538463C 342.31005186601124 138.47638461538463 358.48218030062594 109.32346153846154 377.34966347434306 109.32346153846154C 396.2171466480602 109.32346153846154 412.3892750826749 80.17053846153847 431.25675825639206 80.17053846153847C 450.12424143010924 80.17053846153847 466.29636986472394 58.30584615384615 485.16385303844106 58.30584615384615C 504.03133621215824 58.30584615384615 520.203464646773 36.44115384615387 539.0709478204901 36.44115384615387C 557.9384309942072 36.44115384615387 574.110559428822 7.288230769230779 592.9780426025391 7.288230769230779" pathFrom="M 0 189.494 L 0 189.494 L 53.90709478204901 189.494 L 107.81418956409802 189.494 L 161.72128434614703 189.494 L 215.62837912819603 189.494 L 269.53547391024506 189.494 L 323.44256869229406 189.494 L 377.34966347434306 189.494 L 431.25675825639206 189.494 L 485.16385303844106 189.494 L 539.0709478204901 189.494 L 592.9780426025391 189.494" fill-rule="evenodd"></path><g id="SvgjsG2012" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0"><g class="apexcharts-series-markers"><path id="SvgjsPath2109" d="M 0, 0
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#0ab39c" fill-opacity="1" stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-marker wjpz0zego no-pointer-events" default-marker-size="0"></path></g></g></g><g id="SvgjsG2016" class="apexcharts-series" zIndex="1" seriesName="Expenses" data:longestSeries="true" rel="2" data:realIndex="1"><path id="SvgjsPath2019" d="M 0 180.74812307692306C 18.86748317371715 180.74812307692306 35.03961160833185 177.1040076923077 53.90709478204901 177.1040076923077C 72.77457795576616 177.1040076923077 88.94670639038087 156.69696153846155 107.81418956409802 156.69696153846155C 126.68167273781518 156.69696153846155 142.85380117242988 158.88343076923076 161.72128434614703 158.88343076923076C 180.58876751986418 158.88343076923076 196.76089595447888 172.00224615384616 215.62837912819603 172.00224615384616C 234.49586230191318 172.00224615384616 250.6679907365279 163.9851923076923 269.53547391024506 163.9851923076923C 288.4029570839622 163.9851923076923 304.5750855185769 158.88343076923076 323.44256869229406 158.88343076923076C 342.31005186601124 158.88343076923076 358.48218030062594 134.83226923076924 377.34966347434306 134.83226923076924C 396.2171466480602 134.83226923076924 412.3892750826749 115.15404615384615 431.25675825639206 115.15404615384615C 450.12424143010924 115.15404615384615 466.29636986472394 110.7811076923077 485.16385303844106 110.7811076923077C 504.03133621215824 110.7811076923077 520.203464646773 75.7976 539.0709478204901 75.7976C 557.9384309942072 75.7976 574.110559428822 44.458207692307695 592.9780426025391 44.458207692307695C 592.9780426025391 44.458207692307695 592.9780426025391 44.458207692307695 592.9780426025391 189.494 L 0 189.494z" fill="rgba(240,101,72,0.06)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="1" clip-path="url(#gridRectMasknz46j2mr)" pathTo="M 0 180.74812307692306C 18.86748317371715 180.74812307692306 35.03961160833185 177.1040076923077 53.90709478204901 177.1040076923077C 72.77457795576616 177.1040076923077 88.94670639038087 156.69696153846155 107.81418956409802 156.69696153846155C 126.68167273781518 156.69696153846155 142.85380117242988 158.88343076923076 161.72128434614703 158.88343076923076C 180.58876751986418 158.88343076923076 196.76089595447888 172.00224615384616 215.62837912819603 172.00224615384616C 234.49586230191318 172.00224615384616 250.6679907365279 163.9851923076923 269.53547391024506 163.9851923076923C 288.4029570839622 163.9851923076923 304.5750855185769 158.88343076923076 323.44256869229406 158.88343076923076C 342.31005186601124 158.88343076923076 358.48218030062594 134.83226923076924 377.34966347434306 134.83226923076924C 396.2171466480602 134.83226923076924 412.3892750826749 115.15404615384615 431.25675825639206 115.15404615384615C 450.12424143010924 115.15404615384615 466.29636986472394 110.7811076923077 485.16385303844106 110.7811076923077C 504.03133621215824 110.7811076923077 520.203464646773 75.7976 539.0709478204901 75.7976C 557.9384309942072 75.7976 574.110559428822 44.458207692307695 592.9780426025391 44.458207692307695C 592.9780426025391 44.458207692307695 592.9780426025391 44.458207692307695 592.9780426025391 189.494 L 0 189.494z" pathFrom="M 0 189.494 L 0 189.494 L 53.90709478204901 189.494 L 107.81418956409802 189.494 L 161.72128434614703 189.494 L 215.62837912819603 189.494 L 269.53547391024506 189.494 L 323.44256869229406 189.494 L 377.34966347434306 189.494 L 431.25675825639206 189.494 L 485.16385303844106 189.494 L 539.0709478204901 189.494 L 592.9780426025391 189.494z"></path><path id="SvgjsPath2020" d="M 0 180.74812307692306C 18.86748317371715 180.74812307692306 35.03961160833185 177.1040076923077 53.90709478204901 177.1040076923077C 72.77457795576616 177.1040076923077 88.94670639038087 156.69696153846155 107.81418956409802 156.69696153846155C 126.68167273781518 156.69696153846155 142.85380117242988 158.88343076923076 161.72128434614703 158.88343076923076C 180.58876751986418 158.88343076923076 196.76089595447888 172.00224615384616 215.62837912819603 172.00224615384616C 234.49586230191318 172.00224615384616 250.6679907365279 163.9851923076923 269.53547391024506 163.9851923076923C 288.4029570839622 163.9851923076923 304.5750855185769 158.88343076923076 323.44256869229406 158.88343076923076C 342.31005186601124 158.88343076923076 358.48218030062594 134.83226923076924 377.34966347434306 134.83226923076924C 396.2171466480602 134.83226923076924 412.3892750826749 115.15404615384615 431.25675825639206 115.15404615384615C 450.12424143010924 115.15404615384615 466.29636986472394 110.7811076923077 485.16385303844106 110.7811076923077C 504.03133621215824 110.7811076923077 520.203464646773 75.7976 539.0709478204901 75.7976C 557.9384309942072 75.7976 574.110559428822 44.458207692307695 592.9780426025391 44.458207692307695" fill="none" fill-opacity="1" stroke="#f06548" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="1" clip-path="url(#gridRectMasknz46j2mr)" pathTo="M 0 180.74812307692306C 18.86748317371715 180.74812307692306 35.03961160833185 177.1040076923077 53.90709478204901 177.1040076923077C 72.77457795576616 177.1040076923077 88.94670639038087 156.69696153846155 107.81418956409802 156.69696153846155C 126.68167273781518 156.69696153846155 142.85380117242988 158.88343076923076 161.72128434614703 158.88343076923076C 180.58876751986418 158.88343076923076 196.76089595447888 172.00224615384616 215.62837912819603 172.00224615384616C 234.49586230191318 172.00224615384616 250.6679907365279 163.9851923076923 269.53547391024506 163.9851923076923C 288.4029570839622 163.9851923076923 304.5750855185769 158.88343076923076 323.44256869229406 158.88343076923076C 342.31005186601124 158.88343076923076 358.48218030062594 134.83226923076924 377.34966347434306 134.83226923076924C 396.2171466480602 134.83226923076924 412.3892750826749 115.15404615384615 431.25675825639206 115.15404615384615C 450.12424143010924 115.15404615384615 466.29636986472394 110.7811076923077 485.16385303844106 110.7811076923077C 504.03133621215824 110.7811076923077 520.203464646773 75.7976 539.0709478204901 75.7976C 557.9384309942072 75.7976 574.110559428822 44.458207692307695 592.9780426025391 44.458207692307695" pathFrom="M 0 189.494 L 0 189.494 L 53.90709478204901 189.494 L 107.81418956409802 189.494 L 161.72128434614703 189.494 L 215.62837912819603 189.494 L 269.53547391024506 189.494 L 323.44256869229406 189.494 L 377.34966347434306 189.494 L 431.25675825639206 189.494 L 485.16385303844106 189.494 L 539.0709478204901 189.494 L 592.9780426025391 189.494" fill-rule="evenodd"></path><g id="SvgjsG2017" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="1"><g class="apexcharts-series-markers"><path id="SvgjsPath2110" d="M 0, 0
m -0, 0
a 0,0 0 1,0 0,0
a 0,0 0 1,0 -0,0" fill="#f06548" fill-opacity="1" stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" cx="0" cy="0" shape="circle" class="apexcharts-marker wdmu28aec no-pointer-events" default-marker-size="0"></path></g></g></g><g id="SvgjsG2013" class="apexcharts-datalabels" data:realIndex="0"></g><g id="SvgjsG2018" class="apexcharts-datalabels" data:realIndex="1"></g></g><line id="SvgjsLine2045" x1="0" y1="0" x2="592.9780426025391" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2046" x1="0" y1="0" x2="592.9780426025391" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG2047" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG2048" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText2050" font-family="Helvetica, Arial, sans-serif" x="0" y="217.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2051">Jan</tspan><title>Jan</title></text><text id="SvgjsText2053" font-family="Helvetica, Arial, sans-serif" x="53.907094782049015" y="217.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2054">Feb</tspan><title>Feb</title></text><text id="SvgjsText2056" font-family="Helvetica, Arial, sans-serif" x="107.81418956409803" y="217.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2057">Mar</tspan><title>Mar</title></text><text id="SvgjsText2059" font-family="Helvetica, Arial, sans-serif" x="161.72128434614703" y="217.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2060">Apr</tspan><title>Apr</title></text><text id="SvgjsText2062" font-family="Helvetica, Arial, sans-serif" x="215.62837912819603" y="217.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2063">May</tspan><title>May</title></text><text id="SvgjsText2065" font-family="Helvetica, Arial, sans-serif" x="269.535473910245" y="217.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2066">Jun</tspan><title>Jun</title></text><text id="SvgjsText2068" font-family="Helvetica, Arial, sans-serif" x="323.442568692294" y="217.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2069">Jul</tspan><title>Jul</title></text><text id="SvgjsText2071" font-family="Helvetica, Arial, sans-serif" x="377.349663474343" y="217.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2072">Aug</tspan><title>Aug</title></text><text id="SvgjsText2074" font-family="Helvetica, Arial, sans-serif" x="431.256758256392" y="217.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2075">Sep</tspan><title>Sep</title></text><text id="SvgjsText2077" font-family="Helvetica, Arial, sans-serif" x="485.163853038441" y="217.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2078">Oct</tspan><title>Oct</title></text><text id="SvgjsText2080" font-family="Helvetica, Arial, sans-serif" x="539.0709478204901" y="217.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2081">Nov</tspan><title>Nov</title></text><text id="SvgjsText2083" font-family="Helvetica, Arial, sans-serif" x="592.9780426025392" y="217.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2084">Dec</tspan><title>Dec</title></text></g></g><g id="SvgjsG2106" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG2107" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG2108" class="apexcharts-point-annotations"></g><rect id="SvgjsRect2111" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect><rect id="SvgjsRect2112" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect></g></svg><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-0" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(10, 179, 156);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-1" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(240, 101, 72);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light"><div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="mb-0 card-title flex-grow-1">Deals Status</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted">02 Nov 2021 to 31 Dec 2021<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Last Week</a>
                                    <a class="dropdown-item" href="#">Last Month</a>
                                    <a class="dropdown-item" href="#">Current Year</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table mb-0 align-middle table-borderless table-hover table-nowrap">
                                <thead class="table-light">
                                    <tr class="text-muted">
                                        <th scope="col">Name</th>
                                        <th scope="col" style="width: 20%;">Last Contacted</th>
                                        <th scope="col">Sales Representative</th>
                                        <th scope="col" style="width: 16%;">Status</th>
                                        <th scope="col" style="width: 12%;">Deal Value</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Absternet LLC</td>
                                        <td>Sep 20, 2021</td>
                                        <td><img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="#javascript: void(0);" class="text-body fw-medium">Donald Risher</a>
                                        </td>
                                        <td><span class="p-2 badge bg-success-subtle text-success">Deal Won</span></td>
                                        <td>
                                            <div class="text-nowrap">$100.1K</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Raitech Soft</td>
                                        <td>Sep 23, 2021</td>
                                        <td><img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="#javascript: void(0);" class="text-body fw-medium">Sofia Cunha</a>
                                        </td>
                                        <td><span class="p-2 badge bg-warning-subtle text-warning">Intro Call</span></td>
                                        <td>
                                            <div class="text-nowrap">$150K</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>William PVT</td>
                                        <td>Sep 27, 2021</td>
                                        <td><img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="#javascript: void(0);" class="text-body fw-medium">Luis Rocha</a>
                                        </td>
                                        <td><span class="p-2 badge bg-danger-subtle text-danger">Stuck</span></td>
                                        <td>
                                            <div class="text-nowrap">$78.18K</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Loiusee LLP</td>
                                        <td>Sep 30, 2021</td>
                                        <td><img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="#javascript: void(0);" class="text-body fw-medium">Vitoria Rodrigues</a>
                                        </td>
                                        <td><span class="p-2 badge bg-success-subtle text-success">Deal Won</span></td>
                                        <td>
                                            <div class="text-nowrap">$180K</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apple Inc.</td>
                                        <td>Sep 30, 2021</td>
                                        <td><img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="#javascript: void(0);" class="text-body fw-medium">Vitoria Rodrigues</a>
                                        </td>
                                        <td><span class="p-2 badge bg-info-subtle text-info">New Lead</span></td>
                                        <td>
                                            <div class="text-nowrap">$78.9K</div>
                                        </td>
                                    </tr>
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-5">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="mb-0 card-title flex-grow-1">My Tasks</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted"><i class="align-bottom ri-settings-4-line me-1 fs-15"></i>Settings</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->

                    <div class="p-0 card-body">

                        <div class="p-3 align-items-center justify-content-between d-flex">
                            <div class="flex-shrink-0">
                                <div class="text-muted"><span class="fw-semibold">4</span> of <span class="fw-semibold">10</span> remaining</div>
                            </div>
                            <button type="button" class="btn btn-sm btn-success"><i class="align-middle ri-add-line me-1"></i> Add Task</button>
                        </div><!-- end card header -->

                        <div data-simplebar="init" style="max-height: 219px;" class="simplebar-scrollable-y"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                            <ul class="px-3 border-dashed list-group list-group-flush">
                                <li class="list-group-item ps-0">
                                    <div class="d-flex align-items-start">
                                        <div class="form-check ps-0 flex-sharink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_one">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="mb-0 form-check-label ps-2" for="task_one">Review and make sure nothing slips through cracks</label>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <p class="mb-0 text-muted fs-12">15 Sep, 2021</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item ps-0">
                                    <div class="d-flex align-items-start">
                                        <div class="form-check ps-0 flex-sharink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_two">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="mb-0 form-check-label ps-2" for="task_two">Send meeting invites for sales upcampaign</label>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <p class="mb-0 text-muted fs-12">20 Sep, 2021</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item ps-0">
                                    <div class="d-flex align-items-start">
                                        <div class="form-check flex-sharink-0 ps-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_three">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="mb-0 form-check-label ps-2" for="task_three">Weekly closed sales won checking with sales team</label>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <p class="mb-0 text-muted fs-12">24 Sep, 2021</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item ps-0">
                                    <div class="d-flex align-items-start">
                                        <div class="form-check ps-0 flex-sharink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_four">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="mb-0 form-check-label ps-2" for="task_four">Add notes that can be viewed from the individual view</label>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <p class="mb-0 text-muted fs-12">27 Sep, 2021</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item ps-0">
                                    <div class="d-flex align-items-start">
                                        <div class="form-check ps-0 flex-sharink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_five">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="mb-0 form-check-label ps-2" for="task_five">Move stuff to another page</label>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <p class="mb-0 text-muted fs-12">27 Sep, 2021</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item ps-0">
                                    <div class="d-flex align-items-start">
                                        <div class="form-check ps-0 flex-sharink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_six">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="mb-0 form-check-label ps-2" for="task_six">Styling wireframe design and documentation for velzon admin</label>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <p class="mb-0 text-muted fs-12">27 Sep, 2021</p>
                                        </div>
                                    </div>
                                </li>
                            </ul><!-- end ul -->
                        </div></div></div></div><div class="simplebar-placeholder" style="width: 676px; height: 268px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 178px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
                        <div class="p-3 pt-2">
                            <a href="javascript:void(0);" class="text-muted text-decoration-underline">Show more...</a>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-xxl-5">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="mb-0 card-title flex-grow-1">Upcoming Activities</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted fs-18"><i class="mdi mdi-dots-vertical"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="pt-0 card-body">
                        <ul class="border-dashed list-group list-group-flush">
                            <li class="list-group-item ps-0">
                                <div class="row align-items-center g-3">
                                    <div class="col-auto">
                                        <div class="h-auto p-1 py-2 avatar-sm bg-light rounded-3 material-shadow">
                                            <div class="text-center">
                                                <h5 class="mb-0">25</h5>
                                                <div class="text-muted">Tue</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="mt-0 mb-1 text-muted fs-13">12:00am - 03:30pm</h5>
                                        <a href="#" class="mb-0 text-reset fs-14">Meeting for campaign with sales team</a>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="avatar-group">
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Stine Nielsen">
                                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Jansh Brown">
                                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Dan Gibson">
                                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);">
                                                    <div class="avatar-xxs">
                                                        <span class="text-white avatar-title rounded-circle bg-info">
                                                            5
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </li><!-- end -->
                            <li class="list-group-item ps-0">
                                <div class="row align-items-center g-3">
                                    <div class="col-auto">
                                        <div class="h-auto p-1 py-2 avatar-sm bg-light rounded-3 material-shadow">
                                            <div class="text-center">
                                                <h5 class="mb-0">20</h5>
                                                <div class="text-muted">Wed</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="mt-0 mb-1 text-muted fs-13">02:00pm - 03:45pm</h5>
                                        <a href="#" class="mb-0 text-reset fs-14">Adding a new event with attachments</a>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="avatar-group">
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Frida Bang">
                                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Malou Silva">
                                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Simon Schmidt">
                                                    <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Tosh Jessen">
                                                    <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);">
                                                    <div class="avatar-xxs">
                                                        <span class="text-white avatar-title rounded-circle bg-success">
                                                            3
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </li><!-- end -->
                            <li class="list-group-item ps-0">
                                <div class="row align-items-center g-3">
                                    <div class="col-auto">
                                        <div class="h-auto p-1 py-2 avatar-sm bg-light rounded-3 material-shadow">
                                            <div class="text-center">
                                                <h5 class="mb-0">17</h5>
                                                <div class="text-muted">Wed</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="mt-0 mb-1 text-muted fs-13">04:30pm - 07:15pm</h5>
                                        <a href="#" class="mb-0 text-reset fs-14">Create new project Bundling Product</a>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="avatar-group">
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Nina Schmidt">
                                                    <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Stine Nielsen">
                                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Jansh Brown">
                                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);">
                                                    <div class="avatar-xxs">
                                                        <span class="text-white avatar-title rounded-circle bg-primary">
                                                            4
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </li><!-- end -->
                            <li class="list-group-item ps-0">
                                <div class="row align-items-center g-3">
                                    <div class="col-auto">
                                        <div class="h-auto p-1 py-2 avatar-sm bg-light rounded-3 material-shadow">
                                            <div class="text-center">
                                                <h5 class="mb-0">12</h5>
                                                <div class="text-muted">Tue</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="mt-0 mb-1 text-muted fs-13">10:30am - 01:15pm</h5>
                                        <a href="#" class="mb-0 text-reset fs-14">Weekly closed sales won checking with sales team</a>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="avatar-group">
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Stine Nielsen">
                                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Jansh Brown">
                                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Dan Gibson">
                                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item material-shadow">
                                                <a href="javascript: void(0);">
                                                    <div class="avatar-xxs">
                                                        <span class="text-white avatar-title rounded-circle bg-warning">
                                                            9
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </li><!-- end -->
                        </ul><!-- end -->
                        <div class="mt-2 text-center align-items-center row g-3 text-sm-start">
                            <div class="col-sm">
                                <div class="text-muted">Showing<span class="fw-semibold">4</span> of <span class="fw-semibold">125</span> Results
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <ul class="mb-0 pagination pagination-separated pagination-sm justify-content-center justify-content-sm-start">
                                    <li class="page-item disabled">
                                        <a href="#" class="page-link">←</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">1</a>
                                    </li>
                                    <li class="page-item active">
                                        <a href="#" class="page-link">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">→</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xxl-7">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="mb-0 card-title flex-grow-1">Closing Deals</h4>
                        <div class="flex-shrink-0">
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <option selected="">Closed Deals</option>
                                <option value="1">Active Deals</option>
                                <option value="2">Paused Deals</option>
                                <option value="3">Canceled Deals</option>
                            </select>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle table-bordered table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 30%;">Deal Name</th>
                                        <th scope="col" style="width: 30%;">Sales Rep</th>
                                        <th scope="col" style="width: 20%;">Amount</th>
                                        <th scope="col" style="width: 20%;">Close Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Acme Inc Install</td>
                                        <td><img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="#javascript: void(0);" class="text-body fw-medium">Donald Risher</a>
                                        </td>
                                        <td>$96k</td>
                                        <td>Today</td>
                                    </tr>
                                    <tr>
                                        <td>Save lots Stores</td>
                                        <td><img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="#javascript: void(0);" class="text-body fw-medium">Jansh Brown</a>
                                        </td>
                                        <td>$55.7k</td>
                                        <td>30 Dec 2021</td>
                                    </tr>
                                    <tr>
                                        <td>William PVT</td>
                                        <td><img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="#javascript: void(0);" class="text-body fw-medium">Ayaan Hudda</a>
                                        </td>
                                        <td>$102k</td>
                                        <td>25 Nov 2021</td>
                                    </tr>
                                    <tr>
                                        <td>Raitech Soft</td>
                                        <td><img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="#javascript: void(0);" class="text-body fw-medium">Julia William</a>
                                        </td>
                                        <td>$89.5k</td>
                                        <td>20 Sep 2021</td>
                                    </tr>
                                    <tr>
                                        <td>Absternet LLC</td>
                                        <td><img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-circle me-2 material-shadow">
                                            <a href="#javascript: void(0);" class="text-body fw-medium">Vitoria Rodrigues</a>
                                        </td>
                                        <td>$89.5k</td>
                                        <td>20 Sep 2021</td>
                                    </tr>
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
</x-admin-master>
