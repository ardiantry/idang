!function(t){"use strict";var e=new Tour({steps:[{element:"#tourJumbotron",title:"Jumbotron",content:"This is example of Jumbotron",placement:"left"},{element:"#tourTable",title:"Table",content:"This is example of Table"},{element:"#tourCard",title:"Card",content:"This is example of Card",placement:"left"}],template:"<div class='popover tour-active tour'><div class='arrow'></div><h5 class='popover-title'></h5><div class='popover-content'></div><div class='popover-navigation'><button class='btn btn-info' data-role='prev'>« Prev</button><button class='btn btn-info ml-1' data-role='next'>Next »</button><button class='btn btn-danger ml-2' data-role='end'><i class='mdi mdi-power mr-2'></i>End</button></div></div>",backdrop:"true",autoscroll:"false",orphan:"true"});localStorage.clear(),e.init(),e.start()}(jQuery);