/*

        <div class="feedHead"></div>

        <div class="newsFeed" id="feed">

          <div id="newsFeedNewPost">NEW POST</div>
          <div id="newsFeedHead">Training and Placement Ceil</div>
          <div id="newsFeedNews">T&P Ceil is organizing a training session collobaration with Amazon for 2nd year student </div>
          <div id="newsFeedButton">Check Post</div>

        </div>

        <div class="newsFooter" >

          <div class="feedProgress" id="prgs"></div>
        </div>
*/

function animatedNewsFeed(container, feeds){

  var ctx = document.getElementById(container);

  var newsHead = document.createElement("div");
  var newsFeed = document.createElement("div");

  var newsFeedNewPost = document.createElement("div");
  var newsFeedHead = document.createElement("div");
  var newsFeedNews = document.createElement("div");

  var anchor = document.createElement("a");
  anchor.href = feeds[0][2];
  var newsFeedButton = document.createElement("div");
  anchor.appendChild(newsFeedButton);

  var newsFooter = document.createElement("div");
  var feedProgress = document.createElement("div");

  newsHead.className =  "feedHead";

  newsFeed.className = "newsFeed";
  newsFeedNewPost.className = "newsFeedNewPost";
  newsFeedNewPost.innerHTML = "New Post";
  newsFeedHead.className = "newsFeedHead";
  newsFeedHead.innerHTML = feeds[0][0];
  newsFeedNews.className = "newsFeedNews";
  newsFeedNews.innerHTML = feeds[0][1];
  newsFeedButton.className = "newsFeedButton";
  newsFeedButton.innerHTML = "Check Post";
  newsFooter.className = "newsFooter";
  feedProgress.className = "feedProgress";


  newsFeed.appendChild(newsFeedNewPost);
  newsFeed.appendChild(newsFeedHead);
  newsFeed.appendChild(newsFeedNews);
  //newsFeed.appendChild(newsFeedButton);
  newsFeed.appendChild(anchor);

  newsFooter.appendChild(feedProgress);



  ctx.appendChild(newsHead);
  ctx.appendChild(newsFeed);
  ctx.appendChild(newsFooter);

  var progress = feedProgress;
  var feed = newsFeed;


  function addClass(){
    progress.classList.add("animateProgress");
  }

  function removeClass(){
    progress.classList.remove("animateProgress");
  }




  function settleFeed(){
    feed.classList.remove("hideFeed");
    feed.classList.add("settleFeed");
    feed.style.top = "40px";
  }

  function hideFeed(){
    feed.classList.remove("settleFeed");
    feed.classList.add("hideFeed");
    feed.style.top = "-600px";
  }


  var totalFeed = feeds.length;
  var feedNo = Math.floor(Math.random() * totalFeed);


  function addFeedInfo(){

    if( feedNo==totalFeed ){
      feedNo = 0;
    }

    newsFeedHead.innerHTML = feeds[feedNo][0];
    newsFeedNews.innerHTML = feeds[feedNo][1];
    anchor.href = feeds[feedNo][2];

    feedNo++;
  }

  setTimeout(animate, (Math.random() * 12000));
  var newsTime;


  function animate(){

    addFeedInfo();
    settleFeed();
    addClass();

    newsTime = setInterval(deanimate, 5000);


    newsFeed.onmouseover = function(){
      feed.classList.remove("settleFeed");
      feed.classList.remove("hideFeed");
      newsFeed.style.top = "40px";

      var w = progress.offsetWidth;

      removeClass();
      progress.style.width = (w)+"px";

      clearInterval(newsTime);
    }

    newsFeed.onmouseleave = function(){
      newsTime = setInterval(deanimate, 5000);
      progress.style.width = "0px";
      addClass();
    }


    function deanimate(){

      hideFeed();
      removeClass();
      clearInterval(newsTime);
      setTimeout(animate, 1200);
    }
  }

}


var feeds = [
  [
    ["Training and Placement Ceil"],
    ["T&P Ceil is organizing a training session collobaration with Amazon for 2nd year student"],
    ["http://nitap.ac.in/alumni"],
    ["24 Jan"],
    ["Liton Barman"]
  ],

  [
    ["Computer Science Department"],
    ["CSE Department is organizing a coding Competition on the occasion of World Technology Day"],
    ["http://nitap.ac.in/CSE"],
    ["1 Jan"],
    ["Satyam"]
  ],
  [
    ["Mechenical Department"],
    ["Ferrari Engine Modification Challenge"],
    ["http://nitap.ac.in/Mechenical"],
    ["3 Oct"],
    ["Akrati"]
  ]
];


new animatedNewsFeed("newsFeedContainer1", feeds);
setTimeout(function(){new animatedNewsFeed("newsFeedContainer2", feeds);}, 40);
setTimeout(function(){new animatedNewsFeed("newsFeedContainer3", feeds);}, 120);
setTimeout(function(){new animatedNewsFeed("newsFeedContainer4", feeds);}, 220);

//new animatedNewsFeed("newsFeedContainer3", feeds);
//new animatedNewsFeed("newsFeedContainer4", feeds);


function manageFeeds(){

}
