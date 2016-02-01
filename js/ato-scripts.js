/**
 * Created by xain on 20.01.2016.
 */

var Calc;
Calc = function () {

    this.setup = function () {
        this.initClick();
    };

    this.initClick = function() {

    }
};

function aMap() {

    var self = this;
    /**
     * Options for time on the map in gallery
     * @type {{year: string, month: string, day: string, timezone: string}}
     */
    var timeOptions = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        timezone: 'UTC'
    };

    // Link to the folder with photos
    var imgBaseUrl    =  window.location.href + 'img/photos/';

    // Template for the path to the small photo
    var imgBigTplLink = '{base}big-{year}-{month}-{day}.jpg';

    // Template for the path to the big photo
    this.imgSmlTplLink = '{base}sml-{year}-{month}-{day}.jpg';

    // Template for the one picture in gallery
    var imgSmlTpl = '<a class="fancybox fancybox-button one-map" title="{description}" data-fancybox-group="gallery" href="{iBigLink}">'+
        '<img src="{imgLink}" width="{iW}" height="{iH}" alt="{description}" />'+
        '<span class="date-hint">{description}</span></a>';

    // Дата коли можна знайти найпершу картинку із картою із зони АТО
    var startDay = new Date( 2014, 8-1, 12 );

    var oneDay = 60*60*24*1000; // Кількість мілісекунд

    /**
     * Start date for gallery
     * @type {Date}
     */
    var toDay = new Date();

    /**
     * Count of days from the begining of war with russia
     * @type {number}
     */
    var dayLeft = Math.round((toDay.getTime() - startDay.getTime())/oneDay);

    /**
     * Array of Images in gallery
     * @type {Array}
     */
    var img = [];

    /**
     *
     * @type {Array}
     */
    var tmpUpload = [];

    /**
     * Function to build the the portion of gallery from start date to the finish date
     * @param startDate
     * @param finishDate
     * return the HTML code of gallery
     */
    this.generateGallery = function(startDate, finishDate) {

    };

    this.displayfirst50 = function() {
      console.info(toDay);
    };
};