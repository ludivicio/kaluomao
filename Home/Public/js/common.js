

var maxW = 180;
var maxH = 180;

/**
 * 根据比例重新设置图片的宽和高
 */
function resizeImage(obj) {
    if (obj != null) {
    	imageObject = obj;
    }

	var oldImage = new Image();
 	oldImage.src = imageObject.src;
    
    // var maxW = $(obj).parent('.item-image').width();
    // var maxH = $(obj).parent('.item-image').height();

    var dW = oldImage.width;
    var dH = oldImage.height;
    
    var mTop = 0; // margin-top
    var mLeft = 0; // margin-left
    
    if (dW > maxW || dH > maxH) { 
    	a = dW / maxW; 
    	b = dH / maxH; 
    	if (b > a) {
    		a = b;
    	} 
    	dW = dW / a; 
    	dH = dH / a;
    } 

	mTop = parseInt((maxH - dH) / 2);
	mTop = mTop < 0 ? 0 : mTop;

	mLeft = parseInt((maxW - dW) / 2);
	mLeft = mLeft < 0 ? 0 : mLeft;

    if (dW > 0 && dH > 0) { 
    	imageObject.width = dW; 
    	imageObject.height = dH; 
    	$(imageObject).css('marginTop', mTop);
    	$(imageObject).css('marginLeft', mLeft);
    }

    // alert(' maxW:' + maxW + ' maxH:' + maxH + ' dW:' + dW + ' dH:' + dH + ' mTop:' + mTop + ' mLeft:' + mLeft);
}