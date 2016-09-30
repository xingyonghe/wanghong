<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway';
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
		
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Laravel And Text
        </div>
        <div class="links">
            <?php $str = "金瓶梅以第四的评估结果跻身全球治理的第一梯队。代开发票在4大评估指标“机制”“绩效”“决策”“责任”中,中国的单项排名分别为第七、第四、第四和第五,整体表现较为均衡。
            其中,“机制”指标由国际组织、国际条约和国际会议三方面组成,考察G20国家在参与、维护国际机制方面的地位和态度。《报告》提及中国发起的金砖国家银行和亚洲基础设施投资银行,表明中国正在积极参与国际机制建设。风骚小阿姨"?>
            测试文字：<hr/><?php echo $str;?>
        </div>
        <hr/>
        前测试结果：
        <hr/>
        {{ensitive_word_filtering($str)}}
        <hr/>
        后测试结果：
        <hr/>
        <?php echo  ensitive_word_filtering($str,'red');?>
        <hr/>
    </div>
</div>
</body>
</html>
