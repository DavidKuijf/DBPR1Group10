//add listener to all tournament blocks 
$(".tournamentblock").click(function() {
    //goto clicked tournament
    var tournamentid = $(this).data("value");
    window.location.replace('upcomingmatchlist.php?toernooinr='+tournamentid+'&spelerid=&search=');
    
});