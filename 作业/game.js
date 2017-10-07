/**
 * Created by Administrator on 2017/10/7.
 */
function bind(obj, evType, evFn) {
    if (obj.addEventListener) {
        obj.addEventListener(evType, evFn, false);
    } else if (obj.attachEvent) {
        obj.attachEvent("on" + evType, evFn);
    } else {
        obj["on" + evType] = evFn;
    }
}
(function (window) {
    //游戏构造函数
    function Game() {
        //实例化食物
        this.food = new Food();
        //实例化蛇
        this.snake = new Snake();
        //实例化地图,挂载到this上
        this.map = map;
    };
    //触发事件
    Game.prototype.start = function () {
        this.food.render(this.map);
        this.snake.render(this.map);

        //运动
        runSnake(this);
        //键盘事件
        bindKey(this);
    }
    function runSnake(that) {
        var timer = setInterval(function () {
            that.snake.move(that.food, that.map);

            //检查碰撞
            //获取蛇头的位置
            var headX = that.snake.body[0].x * that.snake.width;
            var headY = that.snake.body[0].y * that.snake.height;
            //获取地图
            var maxX = that.map.offsetWidth;
            var maxY = that.map.offsetHeight;
            //判断
            if (headX < 0 || headX >= maxX) {
                clearInterval(timer);
                alert("over");
                return;
            }
            if (headY < 0 || headY >= maxY) {
                clearInterval(timer);
                alert("over");
                return;
            }
            that.snake.render(that.map);


        }, 300);
    }

    //绑定键盘事件
    function bindKey(that) {
        bind(document, "keydown", function (e) {
            e = e || event;
            switch (e.keyCode) {
                case 37:
                    that.snake.direction = "left";
                    break;
                case 39:
                    that.snake.direction = "right";
                    break;
                case 38:
                    that.snake.direction = "up";
                    break;
                case 40:
                    that.snake.direction = "down";
                    break;
            }
        })
    }

    window.Game = Game;
})(window);