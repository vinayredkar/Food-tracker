<?php 
    enum Estado: string{
        case Recebido = 'Recebido';
        case Preparando = 'Preparando';
        case Pronto = 'Pronto';
        case Entregue = 'Entregue';
        case Nulo = 'null';

        static public function matchEstado(string $estado): Estado {
            $state = Categoria::tryFrom($estado) ?? Estado::Nulo;
            return $state;
        }
    }


?>