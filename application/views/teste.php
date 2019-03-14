<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Menu superior -->
<script>
    $( document ).ready(function() {
       iniciar(); 
    });
//    
//    function iniciar(){
//        var j1 = Math.floor(Math.random() * 100000000000);
//        var j2 = Math.floor(Math.random() * 100000000000);
//        $("#j1").text(j1);
//        $("#j2").text(j2);
//        
//        
//        if(j1 === j2){
//            
//        }else{
//            var jogadas = $("#tt").val();
//            jogadas++;
//            $("#tt").val(jogadas);
//            setTimeout(iniciar, 1);
//        }
//    }

    function iniciar(){
        var posicaoj1 = $("#posicaoj1").val();
        var posicaoj2 = $("#posicaoj2").val();
        console.log(posicaoj1 + ' ' + posicaoj2 );
        var rodadas = $("#rodadas").val();
        if(posicaoj1 === posicaoj2){
            acabou();
        }else
        {
            rodadas++;
            $("#rodadas").val(rodadas);
        }
        var vez = $("#vez").val();
        
        if(vez == 1){
            $("#vez").val(2);
            jogador1();
        }else{
            $("#vez").val(1);
            jogador2();
        }                
    }
    
    function jogador1(){
        var posicao = $("#posicaoj1").val();
        
        var movimento = movimentar();
        
        var posicaoAnterior = posicao;
        posicao = ((posicao * 1 )+ movimento);
        
        if(posicao < 00 || posicao > 99){
            jogador1();
        }else{
            $("#posicaoj1").val(posicao);
            $("#"+posicaoAnterior).text('');
            $("#"+posicaoAnterior).css("background-color", "white");
            $("#"+posicao).text('J1');
             $("#"+posicao).css("background-color", "red");
            setTimeout(iniciar,500);
        }
    }
    
       function jogador2(){
        var posicao = $("#posicaoj2").val();
        
        var movimento = movimentar();
        
        var posicaoAnterior = posicao;
        posicao = ((posicao * 1 )+ movimento);
        
        if(posicao < 00 || posicao > 99){
            jogador2();
        }else{
            $("#posicaoj2").val(posicao);
            $("#"+posicaoAnterior).text('');
            $("#"+posicaoAnterior).css("background-color", "white");
            $("#"+posicao).text('J2');
            $("#"+posicao).css("background-color", "green");
             setTimeout(iniciar,500);
        }
    }
    
    function acabou(){
        var rodadas = $("#rodadas").val();
        alert('O jogo acabou com ' + rodadas + 'rodadas');
    }
    
    function movimentar(){
        
        var direcao = Math.floor(Math.random() * 2) + Math.floor(Math.random() * 2) + Math.floor(Math.random() * 2) + Math.floor(Math.random() * 2);
        
        switch(direcao){
            case 0:
                return 0;
                break;
            case 1:
                return 1;
                break;
            case 2:
                return 10;
                break;
            case 3:
                return -1;
                break;
            case 4:
                return -10;
                break;
        }
        
        console.log(direcao);
    }
    

</script>
<div id="container">
 
   <div id="body">
 
       <?php
 
       foreach($results as $data) {
 
           echo $data->Nome . " - " . $data->Sobrenome . " - " . $data->Sigla ."<br>";
 
       }
 
       ?>
 
       <p><?php echo $links; ?></p>
 
   </div>
 
 
 
</div>
 
</body>
<div style="width: 50%;
  margin: 0 auto;">
<table>
    <?php  
        for($i = 0; $i <= 9; $i++){
            ?>
                <tr style="border: 1px solid; width: 30px; height: 30px" >  
            <?php
            for($j = 0; $j <= 9; $j++){
                ?>
                    <td style="border: 1px solid; width: 30px; height: 30px" id="<?php echo $i . $j; ?>">  <td>
                <?php
            }
             ?>
                </tr>  
            <?php
        }
    ?>
</table>
    </div>
<input type="hidden" value=00 id="posicaoj1">
<input type="hidden" value=99 id="posicaoj2">
<input type="hidden" value=1 id="vez">
<span>Rodadas: - </span><input type="text" value=0 id="rodadas"><br/><br/>


<span>Jogador 1: - </span><span id="j1">J1</span> <br/><br/>
<span>Jogador 2: - </span><span id="j2">J2</span> <br/><br/>
<span>---------------------------------------</span> <br/><br/>
<span>Tentativas: - </span><input type="text" value=0 id="tt"><br/><br/>
<?php 

$quotes = array(
        "I find that the harder I work, the more luck I seem to have. - Thomas Jefferson",
        "Don't stay in bed, unless you can make money in bed. - George Burns",
        "We didn't lose the game; we just ran out of time. - Vince Lombardi",
        "If everything seems under control, you're not going fast enough. - Mario Andretti",
        "Reality is merely an illusion, albeit a very persistent one. - Albert Einstein",
        "Chance favors the prepared mind - Louis Pasteur"
);

echo random_element($quotes);
//$this->benchmark->mark('code_start');
//
//
//    echo $this->table->generate($query);
//
//
//    $data = array(
//            3  => 'http://example.com/news/article/2006/06/03/',
//            7  => 'http://example.com/news/article/2006/06/07/',
//            13 => 'http://example.com/news/article/2006/06/13/',
//            26 => 'http://example.com/news/article/2006/06/26/'
//    );
//
//    echo $this->calendar->generate(2006, 6, $data);
//
//
//
//// Some code happens here
//
//$this->benchmark->mark('code_end');
//
//echo $this->benchmark->elapsed_time('code_start', 'code_end');
?>