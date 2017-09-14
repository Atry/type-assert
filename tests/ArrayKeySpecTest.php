<?hh // strict
/*
 * Copyright (c) 2017, Facebook Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

namespace Facebook\TypeAssert;

use namespace Facebook\TypeSpec;
use type Facebook\TypeSpec\TypeSpec;
use function Facebook\FBExpect\expect;

final class ArrayKeySpecTest extends TypeSpecTest<arraykey> {
  <<__Override>>
  public function getTypeSpec(): TypeSpec<arraykey> {
    return TypeSpec\arraykey();
  }

  <<__Override>>
  public function getValidCoercions(): array<(mixed, arraykey)> {
    return [
      tuple(123, 123),
      tuple(0, 0),
      tuple('0', '0'),
      tuple('123', '123'),
      tuple('1e23', '1e23'),
      tuple(new TestStringable('123'), '123'),
    ];
  }

  <<__Override>>
  public function getInvalidCoercions(): array<array<mixed>> {
    return [
      [1.0],
      [1.23],
      [[123]],
      [vec[]],
      [vec[123]],
      [null],
      [false],
    ];
  }
}
