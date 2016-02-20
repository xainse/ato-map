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
    var imgSmlTplLink = '{base}sml-{year}-{month}-{day}.jpg';

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

    var mapConteinerID = '#map-conteiner';

    /**
     * Function to build the the portion of gallery from start date to the finish date
     * @param startDate
     * @param finishDate
     * return the HTML code of gallery
     */
    this.generateGallery = function(startDate, finishDate) {

        /**
         * 1. Распарсить параметры из даты и запустить цикл
         * 2. Формируем HTML с картинками
         * 3. Инициализирую галерею
         */
        tmpUpload = [];

        // Calc diff between start and finish dates
        var dayDiff = Math.round((finishDate.getTime() - startDate.getTime())/oneDay);

        for (var i=1; i < dayDiff; i++) {
            var cklDate = new Date(finishDate.getTime() - oneDay * i);
            img[i] = self.getOneImg(cklDate);
        }

        return img.join('');
    };

    /**
     * generate html of one img
     * @param date
     */
    this.getOneImg = function(date) {

        var img_result = false;

        var imgData = {
            'base' : imgBaseUrl,
            'year' : date.getFullYear(),
            'month': date.getMonth() + 1, // diff for month in javascript
            'day'  : date.getDate()
        };

        var d = imgData['month']+'/'+imgData['day']+'/'+imgData['year'];
        // validate date
        if (imgData['month'] != 0 && new Date(d) != 'Invalid Date') {

            imgData['day'] = imgData['day']<10?'0'+imgData['day']:imgData['day'];         // add 0 if day < 10
            imgData['month'] = imgData['month']<10?'0'+imgData['month']:imgData['month']; // add 0 if month < 0

            var cklImgLinkBig = imgBigTplLink.supplant(imgData);
            var cklImgLinkSml = imgSmlTplLink.supplant(imgData);
            var img = imgSmlTpl.supplant({
                'iBigLink'	: cklImgLinkBig,
                'imgLink'	: cklImgLinkSml,
                'iW'		: 300,
                'iH'		: 249,
                'description' : date.toLocaleString("uk", timeOptions)
            });

            var immg = new Image();
            immg.onload = function(){

            };
            immg.onerror = function(){
                img[i] = '';
                console.log('can\'t upload the image: '+immg.src);
            };
            immg.src = cklImgLinkSml;

            img_result = img;
        } else {
            wln('Date error: ' + d);
        }

        return img_result;
    };

    /**
     * Upload first 50 images when load page
     */
    this.displayfirst50 = function() {

        var startDay = new Date(2016, 1, 1);
        var images50HTML = self.generateGallery(startDay, toDay);
        $(mapConteinerID).append(images50HTML);
    };
};