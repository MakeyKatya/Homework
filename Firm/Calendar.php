<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Турагенство</title>
    <style>
        body {
            background: url('http://sourceit.local/Фон.jpeg');
        }
        #countries{
            width:800px;
            height: 950px;
            background-color: beige;
            margin-left: 22% ;
        }
        ul {

            list-style: none; /* Для списка убираем маркеры */
            margin-left: 10%; /* Нет отступов вокруг */
            padding: 0 0 0 35px; /* Убираем поля вокруг текста */
            font-family: Arial, sans-serif; /* Рубленый шрифт для текста меню */
            font-size: 20pt; /* Размер названий в пункте меню */
            opacity: 0.8;
        }
        li a {
            display:inline-block;
            padding: 10px 50px; /* Поля вокруг надписи */
            text-decoration: none; /* Подчеркивание у ссылок убираем */
            color: whitesmoke; /* Цвет текста */
            border: 1px solid whitesmoke;/* Рамка вокруг пунктов меню */
            background-color: saddlebrown; /* Цвет фона */
            border-bottom: none; /* Границу снизу не проводим */
            border-radius: 0 10px 0 0;
        }
        li a:hover {
            color: black; /* Цвет текста активного пункта */
            background-color: orange; /* Цвет фона активного пункта */
        }
        li {
            border-bottom: 1px solid #ccc; /* Линия снизу */
        }
        li {
            display:inline-block;
        }
        #table{
            margin-left: 5%;
        }
        .parag {
            margin-left: 6%;
        }

    </style>
</head>
<body>
<h1 align="center" style="color: black"><em><ins>Добро пожаловать на сайт Туристической фирмы "Sky"</ins></em></h1>
<div style="float: left">
    <img src="http://sourceit.local/Европа.jpeg" width="220px" height="160px"/>
    <br>
    <img src="http://sourceit.local/Азия.jpg" width="220px" height="160px"/>
    <br>
    <img src="http://sourceit.local/Америка.jpg" width="220px" height="160px"/>
</div>
<div id="countries">
<br>
    <?php
        $days=$_REQUEST['days'];
        $discount=$_REQUEST['discount'];
        $countries = file('countries.txt');
        $value = array();
            for ($i=0;$i<=count($countries);$i++) {
                $value[$i] = explode(":", $countries[$i]);
            }
    ?>
    <form id="function" method="POST" action="" >
        <h3 align="center"><ins>Чтобы оформить заявку, заполните форму</ins></h3>
        <table>
            <tr>
                <td>
                    <p>Выберите страну, в которую хотите поехать:</p>
                    <table id="table">
                        <tr>
                            <td>
                                <select name="countries">
                                    <?php foreach($value as $key => $index):
                                       if($index[0] == $_REQUEST['countries']):?>
                                            <option selected="selected" value="<?=$index[1] ?>"><?=$index[0]?></option>
                                        <?php else:?>
                                            <option value="<?=$index[1] ?>"><?=$index[0] ?></option>
                                        <?php endif;
                                    endforeach;?>
                                </select>
                            </td>
                        <td><a href="countries.txt" target="_blank">Список стран и наценок</a></td>
                    </table>
                </td>
                <td style="color:beige"><pre>               </pre></td>
                <td>
                    <p align="center"><b>Информация о Вас:</b></p>
                    <br>
                    <p>Введите Ваше имя:</p>
                    <input type="text" name="name">
                </td>
            </tr>
            <tr>
                <td>
                    <p>Введите количество дней поездки:</p>
                    <input type="text" name="days" class="parag">
                </td>
                <td></td>
                <td>
                    <p>Введите Ваш возраст:</p>
                    <input type="text" name="age">
                </td>
            </tr>
            <tr>
                <td>
                    <p>Выберите вашу скидку:</p>
                    <p><input type="radio" name="discount" class="parag" value="0.01">1% - пенсионерам и студентам</p>
                    <p><input type="radio" name="discount" class="parag" value="0.05">5% - скидочная карта "Standart"</p>
                    <p><input type="radio" name="discount" class="parag" value="0.1">10% - скидочная карта "Premium"</p>
                </td>
                <td></td>
                <td>
                    <p>Введите номер вашей дисконтной карты:</p>
                    <input type="text" name="card">
                </td>
            </tr>
        </table>
        <input id="count" type="submit" name="count" style='font-size: 20px' value="Рассчитать стоимость путевки">

    </form>
    <div id="res" align="center"><br></div>
</div>

<script src="jquery.js"></script>
<script type="text/javascript">
    $(function(){
        $('#function').submit(function(e){
            e.preventDefault();
            var formData = $(this).serializeArray();
            console.log(formData);
            $.ajax({
                url: "function.php",
                type: 'post',
                data: formData,
                response:'text',//тип возвращаемого ответа text либо xml
                success: function(data){
                    $('#res').html(data);
                }
            });
        });

    });
</script>

</body>
</html>
