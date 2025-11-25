<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Nova Categoria</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }

        .form-title {
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .error {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
        }

        .alert-errors {
            background: #ffe6e6;
            border: 1px solid #ffcccc;
            color: #c7254e;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-errors ul {
            margin-left: 20px;
        }

        .alert-errors li {
            margin-bottom: 8px;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 25px;
            }

            .form-title {
                font-size: 22px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">➕ Criar Nova Categoria</h1>

        <?php if($errors->any()): ?>
            <div class="alert-errors">
                <strong>Opa! Houve um problema:</strong>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('categories.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="nome">Nome da Categoria *</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    placeholder="Ex: Eletrônicos, Roupas, Alimentos..."
                    value="<?php echo e(old('nome')); ?>"
                    required
                >
                <?php if($errors->has('nome')): ?>
                    <div class="error"><?php echo e($errors->first('nome')); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição (Opcional)</label>
                <textarea 
                    id="descricao" 
                    name="descricao"
                    placeholder="Descreva a categoria..."
                ><?php echo e(old('descricao')); ?></textarea>
                <?php if($errors->has('descricao')): ?>
                    <div class="error"><?php echo e($errors->first('descricao')); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">✓ Criar Categoria</button>
                <a href="<?php echo e(route('categories.index')); ?>" class="btn btn-secondary">← Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php /**PATH /app/resources/views/categories/create.blade.php ENDPATH**/ ?>