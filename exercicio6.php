<?php 
include 'header.php';
 ?>
<div class="">
	<h3> Escolha um dos livros abaixo</h3>
	<div class="alert alert-primary" role="alert">
		A morte dos que não foram<br>
		Joãozinho sem pé
	</div>
	<form method="POST" action=""/>
		<label for="basic-url">Digite o título do livro</label>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
		    <span class="input-group-text" id="basic-addon3">O nome do livro é: </span>
		  	</div>
		  	<input type="text" name="livro" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Digite o título do livro"/>
		  	<div class="input-group-prepend" >
				<select name="perfil" class="custom-select">
					<option value="0">Seu perfil</option>
					<option value="1">Professor</option>
					<option value="2">Aluno</option>
				</select>
			</div>
			<input type="submit" name="botao" value="Verificar" class="btn btn-outline-secondary"/>
		</div>

	</form>
<!-- Caixa de avisos-->

 <?php  

#lista dos dados armazenados no banco de dados
	#livros
	$livrosbd = array(
				array('Titulo' => 'A morte dos que não foram' , 'Tipo' => 'Drama', 'status' => 'Indisponível' ),
				array('Titulo' => 'Joãozinho sem pé' , 'Tipo' => 'Mistério', 'status' => 'Disponível' ),
				);
	#usuários
	$usuarios = array(
				array('Nome' => 'Alfredo' , 'Tipo' => 'Professor' ),
				array('Nome' => 'Ricardo' , 'Tipo' => 'Aluno'),
				);
if (isset($_POST['botao'])) {
	$livro = $_POST['livro'];
	if(isset($livro)){
		resultado($livro, $livrosbd);
	
	}if((empty($livro))){
		errorbusca();
	}
	
}
?>
<?php 

 
#funções
function resultado($livro, $livrosbd){
	$busca = array_search($livro, array_column($livrosbd,'Titulo'));
	
	if (isset($livro)) {
		$situacao = $livrosbd[$busca]['status'];
		switch ($situacao) {
				case 'Disponível':
					buscar1($livro, $livrosbd);
					break;
				case 'Indisponível':
					buscar2($livro, $livrosbd);
					break;
				
			}
	}
}


#caso negativo
function buscar2($livro, $livrosbd){
	if (isset($livro)) {
		
	
	$busca = array_search($livro, array_column($livrosbd,'Titulo'));
	$situacao = $livrosbd[$busca]['status'];
	
	?>
	<div class="alert alert-danger" role="alert">
	  <h4 class="alert-heading">Livro Indisponível</h4>
	  <p>Infelizmente o livro <b class="text-uppercase"><?php echo $livro; ?></b> já está emprestado.</p>
	  <hr>
	  <p class="mb-0">Sempre que precisar, use utilitários de margem para manter as coisas perfeitas.</p>
	</div>
<?php
	}

}
#caso erro total
function errorbusca(){
	?>
	<div class="alert alert-danger" role="alert">
	  <h4 class="alert-heading">Nada selecionado</h4>
	  <p>Precisamos de um nome de livro para fazermos uma busca no nosso banco de dados, por favor entre com um título de um livro.</p>
	  <hr>
	  <p class="mb-0">Sempre que precisar, use utilitários de margem para manter as coisas perfeitas.</p>
	</div>
	<?php
	}

#caso positivo
function buscar1($livro, $livrosbd){
	$busca = array_search($livro, array_column($livrosbd,'Titulo'));
	$situacao = $livrosbd[$busca]['status'];
	switch ($_POST['perfil']) {
		case '0':
			?>
				<div class="alert alert-warning" role="alert">
				  <h4 class="alert-heading">Perfil não encontrado</h4>
				  <p>Antes de Escolher o  <b class="text-uppercase"><?php echo $livro; ?></b> você deve selecionar o seu perfil.</p>
				  <hr>
				  <p class="mb-0">Caso precise de ajude, procure a secretaria do seu curso.</p>
				</div>
			<?php
			break;
		
		case '1':
			?>
				<div class="alert alert-success" role="alert">
				  <h4 class="alert-heading">Disponível para empréstimo</h4>
				  <p>Caro <b> PROFESSOR</b> diante a conjectura da educação do Brasil, você tem um prazo maior para pegar o Livro <b class="text-uppercase"><?php echo $livro?></b> está disponível para empréstimo.</p>
				  <hr>
				  <p class="mb-0"> Caro <b>PROFESSOR</b>, você está fazendo o empréstimo no dia <b><?php echo date('d/m/y') ;?></b>. Você tem a té a data para entregar o livro <?php 
				  		$data = date('d/m/y');
					    $data = DateTime::createFromFormat('d/m/Y', $data);
					    $data->add(new DateInterval('P10D')); // 10 dias
					    echo $data->format('d/m/Y');


				   ?>. <b> Mas a gente dá um jeitinho.</b></p>
					</div>
			<?php
			break;
		case '2':

		?>
		<div class="alert alert-success" role="alert">
		  <h4 class="alert-heading">Disponível para empréstimo</h4>
		  <p>O Livro <b class="text-uppercase"><?php echo $livro?></b> está disponível para empréstimo.</p>
		  <hr>
		  <p class="mb-0"> Caro <b>ALUNO</b>, você está fazendo o empréstimo no dia <b><?php echo date('d/m/y') ;?></b>. Você tem a té a data para entregar o livro <b><?php 
		  		$data = date('d/m/y');
			    $data = DateTime::createFromFormat('d/m/Y', $data);
			    $data->add(new DateInterval('P3D')); // 2 dias
			    echo $data->format('d/m/Y');


		   ?>.</b></p>
	</div>
	<?php
			break;
	}
}

	?>

	


<?php 



?>

</div>

<?php 
include 'footer.php';
 ?>