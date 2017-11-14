//Loading Video Description
$.getJSON(
  "https://spreadsheet.glitch.me/?key=1JMIS9HGurOtifAjFBycuh1l9-2WGYSWN1Ekh9wYsuUs",
  data => {
    console.log(data)
    let containerhtml = "";
    data.forEach(item => {
      containerhtml += template(item);
    });
    $("#latest").html(containerhtml)
  }
);

function template(item) {
  return `
  <div class="quote">
    <p class="lead-video"> ${item.Descriptions}</p>
    <p class="lead-video"> ${item.Descriptions}</p>
  </div>
  `;
}

//Loading Featured Posts
$.getJSON(
  "https://spreadsheet.glitch.me/?key=1EPYB5CZWDJwlkrWjLhEcuAKZnNHJXZNsVZWPElGxqVA",
  data => {
    console.log(data)
    let containerhtml = "";
    data.forEach(item => {
      containerhtml += template_1(item);
    });
    $("#news").html(containerhtml)
  }
);

function template_1(item) {
  return `
    <div class="col-sm-4 top-story">
      <h1 class="featured-video">
        <a href="${item["Story URL"]}">${item.Title}</a>
      </h1>
      <img alt="Photo for story" class="img-responsive" src="${item["Image Title"]}">
      <p class="lead-video"> ${item.Descriptions}</p>
      <a href='${item["Story URL"]}' class="button button-circle">Read More</a>
    </div>
  `;
}

//Loading Single Stories
$.getJSON(
  "https://spreadsheet.glitch.me/?key=1Vteb0_cYNYnKL1DFtUSq6j8fqKqZBzD599zawxXOKts",
  data => {
    console.log(data)
    let containerhtml = "";
    data.forEach(item => {
      containerhtml += template(item);
    });
    $("#single_story").html(containerhtml)
  }
);

function template(item) {
  return `
  <div class="quote">
    <p class="lead-video"> ${item.Descriptions}</p>
  </div>
  `;
}
/* Loading Funders
$.getJSON(
  "https://spreadsheet.glitch.me/?key=Place Key Here",
  data => {
    console.log(data)
    let containerhtml = "";
    data.forEach(item => {
      containerhtml += template_2(item);
    });
    $("#contributors").html(containerhtml)
  }
);

function template_2(item) {
  return `
  <div class="col-sm-4">
    <div class="about-countries-wide">
      <img id="img-circle" class="img-responsive country" src="img/dummy.png">
      <h1 class="featured-contributor">
        <a>${item["Author Name"]}</a>
      </h1>
      <span class="pubdate">${item["Media"]} |</span>
      <span class="pubdate">${item["Author Name"]} | </span>
      <span class="pubdate">${item["Publish Date"]}</span>
      <p class="lead-video">${item.Bio}</p>
    </div>
  </div>
  `;
} */

/* Loading Next
  "https://spreadsheet.glitch.me/?key=14UwvMiLf5S-IYjdiFCXk42i6Ve3Cwy-2i0Tc8G6YAFQ",
  data => {
    console.log(data)
    let containerhtml = "";
    data.forEach(item => {
      containerhtml += template_2(item);
    });
    $("#rootcauses").html(containerhtml)
  }
);

function template_2(item) {
  return `
    <li>
      <span class='pubdate'>${item["Publish Date"]}</span>
      <a href='${item["Story URL"]}'>${item.Title}</a>
      <span class='byline'>By ${item["Author Name"]} </span>
    </li>
  `;
} */

$(function () {
  $(document).scroll(function () {
	  var $nav = $(".navbar-fixed-top");
	  $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	});
});
