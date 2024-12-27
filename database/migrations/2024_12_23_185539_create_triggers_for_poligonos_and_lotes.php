<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crear trigger después de insertar un lote disponible
        DB::unprepared("
            CREATE TRIGGER update_disponibilidad_after_insert
            AFTER INSERT ON lotes
            FOR EACH ROW
            BEGIN
                IF NEW.estado = 'disponible' THEN
                    UPDATE poligonos
                    SET disponibilidad = disponibilidad + 1
                    WHERE id = NEW.poligono_id;
                END IF;
            END;
        ");

        // Crear trigger después de eliminar un lote disponible
        DB::unprepared("
            CREATE TRIGGER update_disponibilidad_after_delete
            AFTER DELETE ON lotes
            FOR EACH ROW
            BEGIN
                IF OLD.estado = 'disponible' THEN
                    UPDATE poligonos
                    SET disponibilidad = disponibilidad - 1
                    WHERE id = OLD.poligono_id;
                END IF;
            END;
        ");

        // Crear trigger después de actualizar un lote
        DB::unprepared("
            CREATE TRIGGER update_disponibilidad_after_update
            AFTER UPDATE ON lotes
            FOR EACH ROW
            BEGIN
                IF OLD.estado != NEW.estado THEN
                    -- Si el estado cambia de 'disponible' a 'no_disponible', disminuir disponibilidad
                    IF OLD.estado = 'disponible' AND NEW.estado = 'no_disponible' THEN
                        UPDATE poligonos
                        SET disponibilidad = disponibilidad - 1
                        WHERE id = NEW.poligono_id;
                    END IF;

                    -- Si el estado cambia de 'no_disponible' a 'disponible', aumentar disponibilidad
                    IF OLD.estado = 'no_disponible' AND NEW.estado = 'disponible' THEN
                        UPDATE poligonos
                        SET disponibilidad = disponibilidad + 1
                        WHERE id = NEW.poligono_id;
                    END IF;
                END IF;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triggers_for_poligonos_and_lotes');
    }
};
