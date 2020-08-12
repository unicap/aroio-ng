################################################################################
#
# python-starlette
#
################################################################################

PYTHON_STARLETTE_VERSION = 0.13.4
PYTHON_STARLETTE_SOURCE = starlette-$(PYTHON_STARLETTE_VERSION).tar.gz
PYTHON_STARLETTE_SITE = https://files.pythonhosted.org/packages/a1/4f/1f9a90f596c4cdfaa7a9ea68dc3e68bc86073f9581acda507a24617780d0
PYTHON_STARLETTE_SETUP_TYPE = setuptools

$(eval $(python-package))
