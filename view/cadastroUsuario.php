<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Customizado -->
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center mb-4">Cadastro de Usuário</h1>
            
            <form action="../control/cadastroUsuarioControl.php" method="post" id="userForm">
                <!-- Seção de Dados Pessoais -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome completo</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="role" class="form-label">Perfil</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="customer" selected>Cliente</option>
                            <option value="admin">Administrador</option>
                            <option value="organizer">Organizador</option>
                        </select>
                    </div>
                </div>

                <!-- Seção de Endereço -->
                <h3 class="mb-3">Endereço</h3>
                
                <div class="row g-3">
                    <div class="col-md-8">
                        <label for="cep" class="form-label">CEP</label>
                        <div class="cep-group">
                            <input type="text" class="form-control" id="cep" name="zip_code" required>
                            <button type="button" class="btn btn-primary" onclick="buscarCEP()">Buscar CEP</button>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="pais" class="form-label">País</label>
                        <input type="text" class="form-control" id="pais" name="country" readonly value="Brasil">
                    </div>

                    <div class="col-md-8">
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" class="form-control" id="logradouro" name="street" required>
                    </div>

                    <div class="col-md-4">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="city" required>
                    </div>

                    <div class="col-md-4">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado" name="state" required>
                    </div>

                    <div class="col-12">
                        <label for="location_name" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="location_name" name="location_name">
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-success btn-lg">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts Customizados -->
    <script src="../js/scripts.js"></script>
</body>
</html>