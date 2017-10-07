/**
 * Created by Administrator on 2017/10/7.
 */
    //       蛇的属性 大小 位置
(function (window) {

    var snakeEles = [];

    function Snake(width, height, direction) {
        //蛇的大小
        this.width = width || 20;
        this.height = height || 20;
        //蛇身
        this.body = [
            {x: 5, y: 3, color: "red"},
            {x: 4, y: 3, color: "yellow"},
            {x: 3, y: 3, color: "yellow"},
        ];
        //蛇头的方向
        this.direction = direction || "right";

    }

    Snake.prototype.render = function (map) {

        remove();
        //3个div
        for (var i = 0; i < this.body.length; i++) {
            var oDiv = document.createElement("div");
            oDiv.style.borderRadius = "60%";
            oDiv.style.width = this.width + "px";
            oDiv.style.height = this.height + "px";

            oDiv.style.left = this.body[i].x * this.width + "px";
            oDiv.style.top = this.body[i].y * this.height + "px";

            //设置颜色
            oDiv.style.backgroundColor = this.body[i].color;
            //在map上绝对定位
            oDiv.style.position = "absolute";

            map.appendChild(oDiv);

            snakeEles.push(oDiv);

        }
        //蛇的构造函数加移动事件
        Snake.prototype.move = function (food,map) {
            for (var i = this.body.length - 1; i > 0; i--) {
                this.body[i].x = this.body[i - 1].x;
                this.body[i].y = this.body[i - 1].y;
            }
            switch (this.direction) {
                case "right":
                    this.body[0].x += 1;
                    break;
                case "left":
                    this.body[0].x -= 1;
                    break;
                case "up":
                    this.body[0].y -= 1;
                    break;
                case "down":
                    this.body[0].y += 1;
                    break;

            }
            //获取蛇头的坐标
            var headX = this.body[0].x * this.width;
            var headY = this.body[0].y * this.height;
            //获取食物的坐标
            var foodX = food.x;
            var foodY = food.y;
            //判断
            if (headX == foodX && headY == foodY) {
                var final = this.body[this.body.length - 1];
                var newJie = {
                    x: final.x,
                    y: final.y,
                    color: final.color
                }
                this.body.push(newJie);
                food.render(map);

            }

        }
        function remove() {
            for (var i = 0; i < snakeEles.length; i++) {
                snakeEles[i].parentNode.removeChild(snakeEles[i]);
            }
            snakeEles = [];
        }
    }

    window.Snake = Snake;
})(window);