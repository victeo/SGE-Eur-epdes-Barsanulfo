<?php 
include 'header.php';
 ?>
<div class="">
	<form method="POST" action=""/>
		<label for="basic-url">Digite o título do livro</label>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
		    <span class="input-group-text" id="basic-addon3">O nome do livro é: </span>
		  	</div>
		  	<input type="text" name="livro" class="form-control" id="basic-url" aria-describedby="basic-addon3"/>
		  	<div class="input-group-prepend">
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
				array('Titulo' => 'A morte dos que não foram' , 'Tipo' => 'Drama', 'status' => 'Indisponíve' ),
				array('Titulo' => 'Joãozinho sem pé' , 'Tipo' => 'Mistério', 'status' => 'Disponíve' ),
				);
	#usuários
	$usuarios = array(
				array('Nome' => 'Alfredo' , 'Tipo' => 'Professor' ),
				array('Nome' => 'Ricardo' , 'Tipo' => 'Aluno'),
				);
if (isset($_POST['botao'])) {
	$livro = $_POST['livro'];
	
	if(is_string($livro)){
		buscar1($livro, $livrosbd);
	}

	
}
?>
<?php 

 
#funções
function buscar1($livro, $livrosbd){
	$busca = array_search($livro, array_column($livrosbd,'Titulo'));
	$situacao = $livrosbd[$busca]['status'];
	


	?>

	<div class="alert alert-success" role="alert">
		  <h4 class="alert-heading">Disponível para empréstimo</h4>
		  <p>O Livro <?php echo $livro?> está disponível para empréstimo.</p>
		  <hr>
		  <p class="mb-0">Você está fazendo o empréstimo no dia <b><?php echo date('d/m/y') ;?></b>. Você tem a té a data para entregar o livro<?php 
		  		$data = date('d/m/y');
			    $data = DateTime::createFromFormat('d/m/Y', $data);
			    $data->add(new DateInterval('P3D')); // 2 dias
			    echo $data->format('d/m/Y');


		   ?></p>
	</div>


	<?php echo $situacao;

};




?>

</div>

<?php 
include 'footer.php';
 ?>