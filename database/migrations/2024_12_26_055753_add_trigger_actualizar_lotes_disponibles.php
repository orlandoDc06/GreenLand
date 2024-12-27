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
        DB::unprepared('
            CREATE TRIGGER trigger_insert_lotes_disponibles
            AFTER INSERT ON lotes
            FOR EACH ROW
            BEGIN
                UPDATE poligonos
                SET lotes_disponibles = (
                    SELECT COUNT(*) 
                    FROM lotes 
                    WHERE poligono_id = NEW.poligono_id AND estado = "Disponible"
                )
                WHERE id = NEW.poligono_id;
            END
        ');

        // Trigger para UPDATE
        DB::unprepared('
            CREATE TRIGGER trigger_update_lotes_disponibles
            AFTER UPDATE ON lotes
            FOR EACH ROW
            BEGIN
                IF (OLD.poligono_id IS NOT NULL) THEN
                    UPDATE poligonos
                    SET lotes_disponibles = (
                        SELECT COUNT(*) 
                        FROM lotes 
                        WHERE poligono_id = OLD.poligono_id AND estado = "Disponible"
                    )
                    WHERE id = OLD.poligono_id;
                END IF;

                IF (NEW.poligono_id IS NOT NULL) THEN
                    UPDATE poligonos
                    SET lotes_disponibles = (
                        SELECT COUNT(*) 
                        FROM lotes 
                        WHERE poligono_id = NEW.poligono_id AND estado = "Disponible"
                    )
                    WHERE id = NEW.poligono_id;
                END IF;
            END
        ');

        // Trigger para DELETE
        DB::unprepared('
            CREATE TRIGGER trigger_delete_lotes_disponibles
            AFTER DELETE ON lotes
            FOR EACH ROW
            BEGIN
                UPDATE poligonos
                SET lotes_disponibles = (
                    SELECT COUNT(*) 
                    FROM lotes 
                    WHERE poligono_id = OLD.poligono_id AND estado = "Disponible"
                )
                WHERE id = OLD.poligono_id;
            END
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trigger_insert_lotes_disponibles');
        DB::unprepared('DROP TRIGGER IF EXISTS trigger_update_lotes_disponibles');
        DB::unprepared('DROP TRIGGER IF EXISTS trigger_delete_lotes_disponibles');
    }
};
