CREATE DATABASE avaliativo DEFAULT CHARACTER SET utf8 ;
USE avaliativo ;

-- -----------------------------------------------------
-- Table `mydb`.`turmas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliativo`.`turmas` (
  `idturmas` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idturmas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`avaliação`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliativo`.`avaliação` (
  `idavaliacao` INT NOT NULL AUTO_INCREMENT,
  `freqAluno` INT,
  `desempenhoAluno` INT,
  `comprometimentoAluno` INT,
  `aprendizadoDisc` INT,
  `didaticaDisc` INT,
  PRIMARY KEY (`idavaliacao`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`disciplinas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliativo`.`disciplinas` (
  `iddisciplinas` INT NOT NULL AUTO_INCREMENT,
  `avaliação_idavaliacao` INT,
  PRIMARY KEY (`iddisciplinas`),
  INDEX `fk_disciplinas_avaliação1_idx` (`avaliação_idavaliacao` ASC),
  CONSTRAINT `fk_disciplinas_avaliação1`
    FOREIGN KEY (`avaliação_idavaliacao`)
    REFERENCES `avaliativo`.`avaliação` (`idavaliacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliativo`.`curso` (
  `idcurso` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `turmas_idturmas` INT NOT NULL,
  `disciplinas_iddisciplinas` INT NOT NULL,
  PRIMARY KEY (`idcurso`),
  INDEX `fk_curso_turmas1_idx` (`turmas_idturmas` ASC),
  INDEX `fk_curso_disciplinas1_idx` (`disciplinas_iddisciplinas` ASC),
  CONSTRAINT `fk_curso_turmas1`
    FOREIGN KEY (`turmas_idturmas`)
    REFERENCES `avaliativo`.`turmas` (`idturmas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curso_disciplinas1`
    FOREIGN KEY (`disciplinas_iddisciplinas`)
    REFERENCES `avaliativo`.`disciplinas` (`iddisciplinas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliativo`.`usuario` (
  `email` VARCHAR(100) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `tipo_usuario` INT COMMENT '0= admin\n1= aluno\n2= professor\n',
  `turmas_idturmas` INT,
  `avaliação_idavaliacao` INT,
  PRIMARY KEY (`email`),
  INDEX `fk_usuario_turmas_idx` (`turmas_idturmas` ASC),
  INDEX `fk_usuario_avaliação1_idx` (`avaliação_idavaliacao` ASC),
  CONSTRAINT `fk_usuario_turmas`
    FOREIGN KEY (`turmas_idturmas`)
    REFERENCES `avaliativo`.`turmas` (`idturmas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_avaliação1`
    FOREIGN KEY (`avaliação_idavaliacao`)
    REFERENCES `avaliativo`.`avaliação` (`idavaliacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;