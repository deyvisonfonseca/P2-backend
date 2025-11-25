<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Categorias</title>
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
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #333;
            margin-bottom: 15px;
        }

        .header p {
            color: #666;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-danger {
            background: #e74c3c;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .btn-warning {
            background: #f39c12;
        }

        .btn-warning:hover {
            background: #e67e22;
        }

        .alert {
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        th {
            padding: 20px;
            text-align: left;
            font-weight: 600;
            color: #333;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid #dee2e6;
            color: #666;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .action-btns {
            display: flex;
            gap: 10px;
        }

        .btn-sm {
            padding: 8px 12px;
            font-size: 14px;
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #666;
        }

        .empty-state p {
            margin-bottom: 20px;
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }

            .action-btns {
                flex-direction: column;
            }

            .btn-sm {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Gerenciar Categorias</h1>
            <p>Gerencie todas as categorias do sistema.</p>
            <a href="<?php echo e(route('categories.create')); ?>" class="btn">+ Nova Categoria</a>
        </div>

        <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success">
                ✓ <?php echo e($message); ?>

            </div>
        <?php endif; ?>

        <div class="table-container">
            <?php if($categories->count() > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 60px;">ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th style="width: 180px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong>#<?php echo e($category->id); ?></strong></td>
                                <td><?php echo e($category->nome); ?></td>
                                <td><?php echo e(Str::limit($category->descricao, 50) ?? '-'); ?></td>
                                <td>
                                    <div class="action-btns">
                                        <a href="<?php echo e(route('categories.edit', $category->id)); ?>" class="btn btn-warning btn-sm">✎ Editar</a>
                                        <form action="<?php echo e(route('categories.destroy', $category->id)); ?>" method="POST" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar esta categoria?');">🗑 Deletar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    <p>📭 Nenhuma categoria encontrada.</p>
                    <a href="<?php echo e(route('categories.create')); ?>" class="btn">+ Criar Primeira Categoria</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php /**PATH /app/resources/views/categories/index.blade.php ENDPATH**/ ?>