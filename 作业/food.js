/**
 * Created by Administrator on 2017/10/7.
 */
    //    食物的属性 width height color x y
(function (window) {

    var oldFood = [];

    function Food(width, height, color, x, y) {
        //初始化
        this.width = width || 20;
        this.height = height || 20;
        this.color = color || "blue";
        this.x = x || 0;
        this.y = y || 0;
    }

    Food.prototype.render = function (map) {

        if (oldFood[0]) {
            remove();
        }

        //食物的随机出现
        this.x = parseInt(Math.random() * (map.offsetWidth / this.width)) * this.width;
        this.y = parseInt(Math.random() * (map.offsetHeight / this.height)) * this.height;


        var oDiv = document.createElement("div");
        //div的大小
        oDiv.style.width = this.width + "px";
        oDiv.style.height = this.height + "px";
        //div的位置
        oDiv.style.left = this.x + "px";
        oDiv.style.top = this.y + "px";
        //颜色
        this.color = "rgb(" + Math.round(Math.random() * 255) + "," + Math.round(Math.random() * 255) + "," + Math.round(Math.random() * 255) + ")";
        oDiv.style.backgroundColor = this.color;
        //添加在地图上的绝对定位
        oDiv.style.position = "absolute";

        map.appendChild(oDiv);

        oldFood.push(oDiv);

    }

    function remove() {
        oldFood[0].parentNode.removeChild(oldFood[0]);
        oldFood.splice(0, 1);
    }


    window.Food = Food;
})(window);