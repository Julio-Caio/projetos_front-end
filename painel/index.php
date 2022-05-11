<!--
    * Start Bootstrap - Resume v7.0.4 (https://startbootstrap.com/theme/resume)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-resume/blob/master/LICENSE)

    * Bootstrap v5.1.3 (https://getbootstrap.com/)
    * Copyright 2011-2021 The Bootstrap Authors
    * Copyright 2011-2021 Twitter, Inc.
    * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
-->

<?php
    session_start();

    if (!$_SESSION) {
        header('location:../login/index.html');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Painel Empresário - Home</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />

        <link href="css/style1.css" rel="stylesheet" />
        <link href="css/style2.css" rel="stylesheet" />
        <script src="js/script.js"></script>
        <!-- CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- icones -->
        <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    </head>


    <body id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
            <div> <a href="../index/index.html" class="nav_logo"> <i class='bx bx-grid-alt nav_logo-icon'></i> <span class="nav_logo-name">Sistema Multilojas</span> </a>
                    <div class="nav_list">
                        <a href="index.php" class="nav_link active">
                            <i class='bx bxs-dashboard nav_icon'></i> <!-- Icone do CSS Externo -->
                            <span class="nav_name">Dashboard</span>
                        </a>
                        <a href="#conta" class="nav_link">
                            <i class='bx bx-user nav_icon'></i> <!-- Icone do CSS Externo -->
                            <span class="nav_name">Conta</span>
                        </a> 
                        <a href="#loja" class="nav_link">
                            <i class='bx bx-store nav_icon'></i> <!-- Icone do CSS Externo -->
                            <span class="nav_name">Loja</span>
                        </a> 
                        <a href="#vendas" class="nav_link">
                            <i class='bx bxs-cart nav_icon'></i> <!-- Icone do CSS Externo -->
                            <span class="nav_name">Vendas</span>
                        </a>
                        <a href="#faturas" class="nav_link">
                            <i class='fas fa-file-invoice-dollar nav_icon'></i> <!-- Icone do CSS Externo -->
                            <span class="nav_name">Faturas</span> 
                        </a>
                        <?php
                            $link_loja = "http://localhost:8080/lojas/".$_SESSION['id_loja']."";
                            echo '<a href="', $link_loja, '" class="nav_link">';
                        ?>
                            <i class='bx bx-store nav_icon'></i> <!-- Icone do CSS Externo -->
                            <span class="nav_name">Ver Loja</span>
                        </a> 
                        </div>
                </div>
                <a href="" class="nav_link" data-toggle="modal" data-target="#modalExemplo">
                    <i class='bx bx-log-out nav_icon'></i>
                    <span class="nav_name">Sair</span>
                </a>
            </nav>
        </div>
        <br><br><br>
        <div class="container">
            <div class="row">

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "multilojas";
            
            $conn = new mysqli($servername, $username, $password, $dbname); /* Vendas Total */
            $id_loja = $_SESSION['possui_loja'];
            $sql = "SELECT * FROM compras WHERE id_loja='$id_loja'";
            $result = $conn->query($sql);
            $total_vendas = $result->num_rows;
            $conn->close();
            
            $conn = new mysqli($servername, $username, $password, $dbname); /* Vendas Aprovadas e Faturamento*/
            $id_loja = $_SESSION['possui_loja'];
            $sql = "SELECT * FROM compras WHERE id_loja='$id_loja' AND status_compra='Aprovado'";
            $result = $conn->query($sql);
            $total_aprovado = $result->num_rows;
            $total_faturado = 0;
            for ($x = 0; $x <= $total_aprovado; $x++) {
                while($row = $result->fetch_assoc()) {
                    $total_faturado = $total_faturado + $row['valor_total_compra'];
                }
            }

            $conn->close();
            
            $conn = new mysqli($servername, $username, $password, $dbname); /* Pedidos Entregues */
            $id_loja = $_SESSION['possui_loja'];
            $sql = "SELECT * FROM compras WHERE id_loja='$id_loja' AND entrega_compra='Sim'";
            $result = $conn->query($sql);
            $total_entregue = $result->num_rows;
            $conn->close();


            if ($_SESSION['possui_loja'] == '1') {
                echo '<div class="col-xl-3 col-lg-6">', /* Informações dos Cards */
                        '<div class="card l-bg-cherry">',
                            '<div class="card-statistic-3 p-4">',
                                '<div class="card-icon card-icon-large">',
                                    '<i class="fas fa-dollar-sign">',
                                    '</i>',
                                '</div>',
                                '<div class="mb-4">',
                                    '<h5 class="card-title mb-0">Faturamento</h5>',
                                '</div>',
                                '<div class="row align-items-center mb-2 d-flex">',
                                    '<div class="col-8">',
                                        '<h2 class="d-flex align-items-center mb-0">',
                                            'R$',$total_faturado,
                                        '</h2>',
                                    '</div>',
                                '</div>',
                            '</div>',
                        '</div>',
                    '</div>',

                    '<div class="col-xl-3 col-lg-6">',
                        '<div class="card l-bg-blue-dark">',
                            '<div class="card-statistic-3 p-4">',
                                '<div class="card-icon card-icon-large">',
                                '<i class="fas fa-shopping-cart">',
                                '</i>',
                                '</div>',
                                '<div class="mb-4">',
                                    '<h5 class="card-title mb-0">Vendas</h5>',
                                '</div>',
                                '<div class="row align-items-center mb-2">',
                                    '<div class="col-8">',
                                        '<h2 class="d-flex align-items-center mb-0">',
                                            $total_vendas,
                                        '</h2>',
                                    '</div>',
                                '</div>',
                            '</div>',
                        '</div>',
                    '</div>',

                    '<div class="col-xl-3 col-lg-6">',
                        '<div class="card l-bg-green-dark">',
                            '<div class="card-statistic-3 p-4">',
                                '<div class="card-icon card-icon-large"><i class="fas fa-check">',
                                '</i>',
                                '</div>',
                                '<div class="mb-4">',
                                    '<h5 class="card-title mb-0">Vendas Aprovadas</h5>',
                                '</div>',
                                '<div class="row align-items-center mb-2 d-flex">',
                                    '<div class="col-8">',
                                        '<h2 class="d-flex align-items-center mb-0">',
                                            $total_aprovado,
                                        '</h2>',
                                    '</div>',
                                '</div>',
                            '</div>',
                        '</div>',
                    '</div>',
                    
                    '<div class="col-xl-3 col-lg-6">',
                        '<div class="card l-bg-orange-dark">',
                            '<div class="card-statistic-3 p-4">',
                                '<div class="card-icon card-icon-large"><i class="fas fa-check">',
                                '</i>',
                                '</div>',
                                '<div class="mb-4">',
                                    '<h5 class="card-title mb-0">Pedidos Entregues</h5>',
                                '</div>',
                                '<div class="row align-items-center mb-2 d-flex">',
                                    '<div class="col-8">',
                                        '<h2 class="d-flex align-items-center mb-0">',
                                            $total_entregue,
                                        '</h2>',
                                    '</div>',
                                '</div>',
                            '</div>',
                        '</div>',
                    '</div>',
                '</div>',
            '</div>'
                ;
            } else {
                echo "Você não possui loja!";
            }
        ?>

        <div class="col-lg-10 mx-auto">
            <div class="card rounded shadow border-0">
              <div class="card-body p-5 bg-white rounded">
                <div class="table-responsive">
                  <table id="example" style="width:100%" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td><b>Nome do Cliente</b></td>
                            <td><b>Quantidade de Produtos</b></td>
                            <td><b>Valor</b></td>
                            <td><b>Data</b></td>
                            <td><b>Meio de Pagamento</b></td>
                            <td><b>Status de Entrega</b></td>
                            <td><b>Status de Pagamento</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $conn = new mysqli($servername, $username, $password, $dbname); /* Pedidos Entregues */
                            $id_loja = $_SESSION['possui_loja'];
                            $sql = "SELECT * FROM compras WHERE id_loja='$id_loja'";
                            $result = $conn->query($sql);
                            $result->num_rows;
                            if ($result->num_rows > 0) {
                                for ($x = 0; $x <= $total_aprovado; $x++) {
                                    while($row = $result->fetch_assoc()) {
                                        echo
                                        '<tr>',
                                            '<td>',$row['nome_comprador'],'</td>',
                                            '<td>',$row['qtde_produtos'],'</td>',
                                            '<td>',$row['valor_total_compra'],'</td>',
                                            '<td>',$row['data_compra'],'</td>',
                                            '<td>',$row['forma_pagamento_compra'],'</td>',
                                            '<td>',$row['entrega_compra'],'</td>',
                                            '<td>',$row['status_compra'],'</td>',
                                        '</tr>';
                                    }
                                }
                            }
                            $conn->close();
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Modal de Deslogar -->
        <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    Tem certeza que deseja Sair?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='sair.php'">Sair</button>
                    </div>
                </div>
            </div>
        </div>

    </body>

</html>