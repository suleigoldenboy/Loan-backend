<?php

namespace MathPHP\LinearAlgebra;

use MathPHP\Functions\Support;
use MathPHP\Exception;

/**
 * m x n Matrix
 */
abstract class MatrixBase implements \ArrayAccess, \JsonSerializable
{
    /** @var int Number of rows */
    protected $m;

    /** @var int Number of columns */
    protected $n;

    /** @var array Matrix array of arrays */
    protected $A;

    /** @var MatrixCatalog */
    protected $catalog;

    /**************************************************************************
     * ABSTRACT METHODS
     *  - getObjectType
     **************************************************************************/

    /**
     * What type of data does the matrix contain
     *
     * @return string the type of data in the Matrix
     */
    abstract public function getObjectType(): string;

    /**************************************************************************
     * BASIC MATRIX GETTERS
     *  - getMatrix
     *  - getM
     *  - getN
     *  - getRow
     *  - getColumn
     *  - get
     *  - getDiagonalElements
     *  - getSuperdiagonalElements
     *  - getSubdiagonalElements
     *  - asVectors
     **************************************************************************/

    /**
     * Get matrix
     * @return array[] of arrays
     */
    public function getMatrix(): array
    {
        return $this->A;
    }

    /**
     * Get row count (m)
     * @return int number of rows
     */
    public function getM(): int
    {
        return $this->m;
    }

    /**
     * Get column count (n)
     * @return int number of columns
     */
    public function getN(): int
    {
        return $this->n;
    }

    /**
     * Get single row from the matrix
     *
     * @param  int    $i row index (from 0 to m - 1)
     * @return array
     *
     * @throws Exception\MatrixException if row i does not exist
     */
    public function getRow(int $i): array
    {
        if ($i >= $this->m) {
            throw new Exception\MatrixException("Row $i does not exist");
        }

        return $this->A[$i];
    }

    /**
     * Get single column from the matrix
     *
     * @param  int   $j column index (from 0 to n - 1)
     * @return array
     *
     * @throws Exception\MatrixException if column j does not exist
     */
    public function getColumn(int $j): array
    {
        if ($j >= $this->n) {
            throw new Exception\MatrixException("Column $j does not exist");
        }

        return array_column($this->A, $j);
    }

    /**
     * Get a specific value at row i, column j
     *
     * @param  int    $i row index
     * @param  int    $j column index
     * @return number
     *
     * @throws Exception\MatrixException if row i or column j does not exist
     */
    public function get(int $i, int $j)
    {
        if ($i >= $this->m) {
            throw new Exception\MatrixException("Row $i does not exist");
        }
        if ($j >= $this->n) {
            throw new Exception\MatrixException("Column $j does not exist");
        }

        return $this->A[$i][$j];
    }

    /**
     * Returns the elements on the diagonal of a square matrix as an array
     *     [1 2 3]
     * A = [4 5 6]
     *     [7 8 9]
     *
     * getDiagonalElements($A) = [1, 5, 9]
     *
     * @return array
     */
    public function getDiagonalElements(): array
    {
        $diagonal = [];
        for ($i = 0; $i < min($this->m, $this->n); $i++) {
            $diagonal[] = $this->A[$i][$i];
        }

        return $diagonal;
    }

    /**
     * Returns the elements on the superdiagonal of a square matrix as an array
     *     [1 2 3]
     * A = [4 5 6]
     *     [7 8 9]
     *
     * getSuperdiagonalElements($A) = [2, 6]
     *
     * http://mathworld.wolfram.com/Superdiagonal.html
     *
     * @return array
     */
    public function getSuperdiagonalElements(): array
    {
        $superdiagonal = [];
        if ($this->isSquare()) {
            for ($i = 0; $i < $this->m - 1; $i++) {
                $superdiagonal[] = $this->A[$i][$i + 1];
            }
        }
        return $superdiagonal;
    }

    /**
     * Returns the elements on the subdiagonal of a square matrix as an array
     *     [1 2 3]
     * A = [4 5 6]
     *     [7 8 9]
     *
     * getSubdiagonalElements($A) = [4, 8]
     *
     * http://mathworld.wolfram.com/Subdiagonal.html
     *
     * @return array
     */
    public function getSubdiagonalElements(): array
    {
        $subdiagonal = [];
        if ($this->isSquare()) {
            for ($i = 1; $i < $this->m; $i++) {
                $subdiagonal[] = $this->A[$i][$i - 1];
            }
        }
        return $subdiagonal;
    }

    /**
     * Returns an array of vectors from the columns of the matrix.
     * Each column of the matrix becomes a vector.
     *
     *     [1 2 3]
     * A = [4 5 6]
     *     [7 8 9]
     *
     *           [1] [2] [3]
     * Vectors = [4] [5] [6]
     *           [7] [8] [9]
     *
     * @return Vector[]
     */
    public function asVectors(): array
    {
        $n       = $this->n;
        $vectors = [];

        for ($j = 0; $j < $n; $j++) {
            $vectors[] = new Vector(array_column($this->A, $j));
        }

        return $vectors;
    }

    /**
     * Returns an array of vectors from the columns of the matrix.
     * Each column of the matrix becomes a vector.
     *
     *     [1 2 3]
     * A = [4 5 6]
     *     [7 8 9]
     *
     *           [1] [4] [7]
     * Vectors = [2] [5] [8]
     *           [3] [6] [9]
     *
     * @return Vector[]
     */
    public function asRowVectors(): array
    {
        return array_map(
            function (array $row) {
                return new Vector($row);
            },
            $this->A
        );
    }

    /***************************************************************************
     * MATRIX COMPARISONS
     *  - isEqualSizeAndType
     ***************************************************************************/

    /**
     * Is this matrix the same size and type as some other matrix?
     *
     * @param Matrix $B
     *
     * @return bool
     */
    protected function isEqualSizeAndType(Matrix $B): bool
    {
        if ($this->getObjectType() !== $B->getObjectType()) {
            return false;
        }

        $m = $this->m;
        $n = $this->n;

        // Same dimensions
        if ($m != $B->m || $n != $B->n) {
            return false;
        }

        return true;
    }

    /**************************************************************************
     * MATRIX PROPERTIES
     *  - isSquare
     **************************************************************************/

    /**
     * Is the matrix a square matrix?
     * Do rows m = columns n?
     *
     * @return bool true if square; false otherwise.
     */
    public function isSquare(): bool
    {
        return $this->m === $this->n;
    }

    /**************************************************************************
     * MATRIX AUGMENTATION - Return a Matrix
     *  - augment
     *  - augmentBelow
     *  - augmentAbove
     *  - augmentLeft
     **************************************************************************/

    /**
     * Augment a matrix
     * An augmented matrix is a matrix obtained by appending the columns of two given matrices
     *
     *     [1, 2, 3]
     * A = [2, 3, 4]
     *     [3, 4, 5]
     *
     *     [4]
     * B = [5]
     *     [6]
     *
     *         [1, 2, 3 | 4]
     * (A|B) = [2, 3, 4 | 5]
     *         [3, 4, 5 | 6]
     *
     * @param  Matrix $B Matrix columns to add to matrix A
     *
     * @return Matrix
     *
     * @throws Exception\MatrixException if matrices do not have the same number of rows
     * @throws Exception\IncorrectTypeException
     */
    public function augment(Matrix $B): Matrix
    {
        if ($this->getObjectType() !== $B->getObjectType()) {
            throw new Exception\MatrixException('Matrices must be the same type.');
        }
        if ($B->getM() !== $this->m) {
            throw new Exception\MatrixException('Matrices to augment do not have the same number of rows');
        }

        $m    = $this->m;
        $A    = $this->A;
        $B    = $B->getMatrix();
        $???A???B??? = [];

        for ($i = 0; $i < $m; $i++) {
            $???A???B???[$i] = array_merge($A[$i], $B[$i]);
        }

        return MatrixFactory::create($???A???B???);
    }

    /**
     * Augment a matrix on the left
     * An augmented matrix is a matrix obtained by preprending the columns of two given matrices
     *
     *     [1, 2, 3]
     * A = [2, 3, 4]
     *     [3, 4, 5]
     *
     *     [4]
     * B = [5]
     *     [6]
     *
     *         [4 | 1, 2, 3]
     * (A|B) = [5 | 2, 3, 4]
     *         [6 | 3, 4, 5]
     *
     * @param  Matrix $B Matrix columns to add to matrix A
     *
     * @return Matrix
     *
     * @throws Exception\MatrixException if matrices do not have the same number of rows
     * @throws Exception\IncorrectTypeException
     */
    public function augmentLeft(Matrix $B): Matrix
    {
        if ($this->getObjectType() !== $B->getObjectType()) {
            throw new Exception\MatrixException('Matrices must be the same type.');
        }
        if ($B->getM() !== $this->m) {
            throw new Exception\MatrixException('Matrices to augment do not have the same number of rows');
        }

        $m    = $this->m;
        $A    = $this->A;
        $B    = $B->getMatrix();
        $???B???A??? = [];

        for ($i = 0; $i < $m; $i++) {
            $???B???A???[$i] = array_merge($B[$i], $A[$i]);
        }

        return MatrixFactory::create($???B???A???);
    }

    /**
     * Augment a matrix from below
     * An augmented matrix is a matrix obtained by appending the rows of two given matrices
     *
     *     [1, 2, 3]
     * A = [2, 3, 4]
     *     [3, 4, 5]
     *
     * B = [4, 5, 6]
     *
     *         [1, 2, 3]
     * (A_B) = [2, 3, 4]
     *         [3, 4, 5]
     *         [4, 5, 6]
     *
     * @param  Matrix $B Matrix rows to add to matrix A
     *
     * @return Matrix
     *
     * @throws Exception\MatrixException if matrices do not have the same number of columns
     * @throws Exception\IncorrectTypeException
     */
    public function augmentBelow(Matrix $B): Matrix
    {
        if ($this->getObjectType() !== $B->getObjectType()) {
            throw new Exception\MatrixException('Matrices must be the same type.');
        }
        if ($B->getN() !== $this->n) {
            throw new Exception\MatrixException('Matrices to augment do not have the same number of columns');
        }

        $???A???B??? = array_merge($this->A, $B->getMatrix());

        return MatrixFactory::create($???A???B???);
    }

    /**
     * Augment a matrix from above
     * An augmented matrix is a matrix obtained by prepending the rows of two given matrices
     *
     *     [1, 2, 3]
     * A = [2, 3, 4]
     *     [3, 4, 5]
     *
     * B = [4, 5, 6]
     *
     *         [4, 5, 6]
     *         [1, 2, 3]
     * (A_B) = [2, 3, 4]
     *         [3, 4, 5]
     *
     * @param  Matrix $B Matrix rows to add to matrix A
     *
     * @return Matrix
     *
     * @throws Exception\BadDataException
     * @throws Exception\IncorrectTypeException
     * @throws Exception\MathException
     * @throws Exception\MatrixException
     */
    public function augmentAbove(Matrix $B): Matrix
    {
        if ($this->getObjectType() !== $B->getObjectType()) {
            throw new Exception\MatrixException('Matrices must be the same type.');
        }
        if ($B->getN() !== $this->n) {
            throw new Exception\MatrixException('Matrices to augment do not have the same number of columns');
        }

        $???A???B??? = array_merge($B->getMatrix(), $this->A);

        return MatrixFactory::create($???A???B???);
    }

    /**************************************************************************
     * MATRIX OPERATIONS - Return a Matrix
     *  - transpose
     *  - submatrix
     *  - insert
     **************************************************************************/

    /**
     * Transpose matrix
     *
     * The transpose of a matrix A is another matrix A???:
     *  - reflect A over its main diagonal (which runs from top-left to bottom-right) to obtain AT
     *  - write the rows of A as the columns of AT
     *  - write the columns of A as the rows of AT
     * Formally, the i th row, j th column element of A??? is the j th row, i th column element of A.
     * If A is an m ?? n matrix then A??? is an n ?? m matrix.
     * https://en.wikipedia.org/wiki/Transpose
     *
     * @return Matrix
     *
     * @throws Exception\MatrixException
     * @throws Exception\IncorrectTypeException
     */
    public function transpose()
    {
        if ($this->catalog->hasTranspose()) {
            return $this->catalog->getTranspose();
        }

        $A??? = [];
        for ($i = 0; $i < $this->n; $i++) {
            $A???[$i] = $this->getColumn($i);
        }

        $this->catalog->addTranspose(MatrixFactory::create($A???));
        return $this->catalog->getTranspose();
    }

    /**
     * Submatrix
     *
     * Return an arbitrary subset of a Matrix as a new Matrix.
     *
     * @param int $m??? Starting row
     * @param int $n??? Starting column
     * @param int $m??? Ending row
     * @param int $n??? Ending column
     *
     * @return Matrix
     *
     * @throws Exception\MatrixException
     */
    public function submatrix(int $m???, int $n???, int $m???, int $n???): Matrix
    {
        if ($m??? >= $this->m || $m??? < 0 || $m??? >= $this->m || $m??? < 0) {
            throw new Exception\MatrixException('Specified Matrix row does not exist');
        }
        if ($n??? >= $this->n || $n??? < 0 || $n??? >= $this->n || $n??? < 0) {
            throw new Exception\MatrixException('Specified Matrix column does not exist');
        }
        if ($m??? < $m???) {
            throw new Exception\MatrixException('Ending row must be greater than beginning row');
        }
        if ($n??? < $n???) {
            throw new Exception\MatrixException('Ending column must be greater than the beginning column');
        }

        $A = [];
        for ($i = 0; $i <= $m??? - $m???; $i++) {
            for ($j = 0; $j <= $n??? - $n???; $j++) {
                $A[$i][$j] = $this->A[$i + $m???][$j + $n???];
            }
        }

        return MatrixFactory::create($A);
    }

    /**
     * Insert
     * Insert a smaller matrix within a larger matrix starting at a specified position
     *
     * @param Matrix $small the smaller matrix to embed
     * @param int $m Starting row
     * @param int $n Starting column
     *
     * @return Matrix
     *
     * @throws Exception\MatrixException
     */
    public function insert(Matrix $small, int $m, int $n): Matrix
    {
        if ($this->getObjectType() !== $small->getObjectType()) {
            throw new Exception\MatrixException('Matrices must be the same type.');
        }
        if ($small->getM() + $m > $this->m || $small->getN() + $n > $this->n) {
            throw new Exception\MatrixException('Inner matrix exceeds the bounds of the outer matrix');
        }

        $new_array = $this->A;
        for ($i = 0; $i < $small->getM(); $i++) {
            for ($j = 0; $j < $small->getN(); $j++) {
                $new_array[$i + $m][$j + $n] = $small[$i][$j];
            }
        }
        return MatrixFactory::create($new_array);
    }

    /**************************************************************************
     * MATRIX MAPPING
     *  - map
     *  - mapRows
     **************************************************************************/

    /**
     * Map a function over all elements of the Matrix
     *
     * @param  callable $func takes a matrix item as input
     *
     * @return Matrix
     *
     * @throws Exception\IncorrectTypeException
     */
    public function map(callable $func): Matrix
    {
        $m = $this->m;
        $n = $this->n;
        $R = [];

        for ($i = 0; $i < $m; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $R[$i][$j] = $func($this->A[$i][$j]);
            }
        }

        return MatrixFactory::create($R);
    }

    /**
     * Map a function over the rows of the matrix
     *
     * @param callable $func
     *
     * @return array|array[] Depends on the function
     */
    public function mapRows(callable $func): array
    {
        return array_map(
            $func,
            $this->A
        );
    }

    /**************************************************************************
     * ROW OPERATIONS - Return a Matrix
     *  - rowInterchange
     *  - rowExclude
     **************************************************************************/

    /**
     * Interchange two rows
     *
     * Row m??? changes to position m???
     * Row m??? changes to position m???
     *
     * @param int $m??? Row to swap into row position m???
     * @param int $m??? Row to swap into row position m???
     *
     * @return Matrix with rows m??? and m??? interchanged
     *
     * @throws Exception\MatrixException if row to interchange does not exist
     * @throws Exception\IncorrectTypeException
     */
    public function rowInterchange(int $m???, int $m???): Matrix
    {
        if ($m??? >= $this->m || $m??? >= $this->m) {
            throw new Exception\MatrixException('Row to interchange does not exist');
        }

        $m = $this->m;
        $R = [];

        for ($i = 0; $i < $m; $i++) {
            switch ($i) {
                case $m???:
                    $R[$i] = $this->A[$m???];
                    break;
                case $m???:
                    $R[$i] = $this->A[$m???];
                    break;
                default:
                    $R[$i] = $this->A[$i];
            }
        }

        return MatrixFactory::create($R);
    }

    /**
     * Exclude a row from the result matrix
     *
     * @param int $m??? Row to exclude
     *
     * @return Matrix with row m??? excluded
     *
     * @throws Exception\MatrixException if row to exclude does not exist
     * @throws Exception\IncorrectTypeException
     */
    public function rowExclude(int $m???): Matrix
    {
        if ($m??? >= $this->m || $m??? < 0) {
            throw new Exception\MatrixException('Row to exclude does not exist');
        }

        $m = $this->m;
        $R = [];

        for ($i = 0; $i < $m; $i++) {
            if ($i === $m???) {
                continue;
            }
            $R[$i] = $this->A[$i];
        }

        return MatrixFactory::create(array_values($R));
    }

    /**************************************************************************
     * COLUMN OPERATIONS - Return a Matrix
     *  - columnInterchange
     *  - columnExclude
     **************************************************************************/

    /**
     * Interchange two columns
     *
     * Column n??? changes to position n???
     * Column n??? changes to position n???
     *
     * @param int $n??? Column to swap into column position n???
     * @param int $n??? Column to swap into column position n???
     *
     * @return Matrix with columns n??? and n??? interchanged
     *
     * @throws Exception\MatrixException if column to interchange does not exist
     * @throws Exception\IncorrectTypeException
     */
    public function columnInterchange(int $n???, int $n???): Matrix
    {
        if ($n??? >= $this->n || $n??? >= $this->n) {
            throw new Exception\MatrixException('Column to interchange does not exist');
        }

        $m = $this->m;
        $n = $this->n;
        $R = [];

        for ($i = 0; $i < $m; $i++) {
            for ($j = 0; $j < $n; $j++) {
                switch ($j) {
                    case $n???:
                        $R[$i][$j] = $this->A[$i][$n???];
                        break;
                    case $n???:
                        $R[$i][$j] = $this->A[$i][$n???];
                        break;
                    default:
                        $R[$i][$j] = $this->A[$i][$j];
                }
            }
        }

        return MatrixFactory::create($R);
    }

    /**
     * Exclude a column from the result matrix
     *
     * @param int $n??? Column to exclude
     *
     * @return Matrix with column n??? excluded
     *
     * @throws Exception\MatrixException if column to exclude does not exist
     * @throws Exception\IncorrectTypeException
     */
    public function columnExclude(int $n???): Matrix
    {
        if ($n??? >= $this->n || $n??? < 0) {
            throw new Exception\MatrixException('Column to exclude does not exist');
        }

        $m = $this->m;
        $n = $this->n;
        $R = [];

        for ($i = 0; $i < $m; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($j === $n???) {
                    continue;
                }
                $R[$i][$j] = $this->A[$i][$j];
            }
        }

        // Reset column indexes
        for ($i = 0; $i < $m; $i++) {
            $R[$i] = array_values($R[$i]);
        }

        return MatrixFactory::create($R);
    }

    /**************************************************************************
     * ArrayAccess INTERFACE
     **************************************************************************/

    /**
     * @param mixed $i
     * @return bool
     */
    public function offsetExists($i): bool
    {
        return isset($this->A[$i]);
    }

    /**
     * @param mixed $i
     * @return mixed
     */
    public function offsetGet($i)
    {
        return $this->A[$i];
    }

    /**
     * @param  mixed $i
     * @param  mixed $value
     * @throws Exception\MatrixException
     */
    public function offsetSet($i, $value)
    {
        throw new Exception\MatrixException('Matrix class does not allow setting values');
    }

    /**
     * @param  mixed $i
     * @throws Exception\MatrixException
     */
    public function offsetUnset($i)
    {
        throw new Exception\MatrixException('Matrix class does not allow unsetting values');
    }

    /**************************************************************************
     * JsonSerializable INTERFACE
     **************************************************************************/
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->A;
    }
}
