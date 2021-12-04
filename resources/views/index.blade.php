<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cliente</title>
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="app-body">
            <div class="sidebar">
                <nav class="navbar  navbar-expand-lg navbar-dark bg-secondary">
                    <a @click="menu=0" class="navbar-brand"  href="#"></a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li @click="menu=1" class="nav-item">
                         <!--  <a class="nav-link" href="#">cliente</a> -->
                            </li>
                            <li @click="menu=2" class="nav-item">
                             <!--<a class="nav-link" href="#">categoria</a> -->
                            </li>
                            <li @click="menu=3" class="nav-item">
                               <!-- <a class="nav-link" href="#">producto</a>-->
                            </li>
                            <li @click="menu=4" class="nav-item">
                               <!-- <a class="nav-link" href="#">notaventa</a>-->
                            </li>
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#">FrmEmpresa</a>
                            </li>
                        </ul>
                    </div>
                </nav>                     
            </div>
            <template v-if="menu==0">
              <h2>SOFTWARE2</h2>
            </template>

            <template v-if="menu==1">
                <frm-cliente></frm-cliente>
            </template>

           <template v-if="menu==2">
                <frm-categoria></frm-categoria>
            </template>

           <template v-if="menu==3">
                <frm-producto></frm-producto>
            </template>

            <template v-if="menu==4">
                <frm-notaventa></frm-notaventa>
            </template>
            <template v-if="menu==5">
                <frm-empresa></frm-empresa>
            </template>
        </div>
    </div>
    <script src="js/app.js"></script>
</body>
</html>