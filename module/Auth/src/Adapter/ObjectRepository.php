<?php

namespace Auth\Adapter;

use DoctrineModule\Authentication\Adapter\ObjectRepository as BaseObjectRepository;
use Zend\Authentication\Result as AuthenticationResult;

use Zend\Authentication\Adapter\Exception;

class ObjectRepository extends BaseObjectRepository
{
    private $internalAuthentication = false;

    /**
     * {@inheritDoc}
     */
    public function authenticate()
    {

        $this->setup();
        $options  = $this->options;
        $identity = $options
            ->getObjectRepository()
            ->findOneBy([
                $options->getIdentityProperty() => $this->identity,
                'active'                        => 1,
            ]);

        if (!$identity) {
            $this->authenticationResultInfo['code']       = AuthenticationResult::FAILURE_IDENTITY_NOT_FOUND;
            $this->authenticationResultInfo['messages'][] = 'A record with the supplied identity could not be found.';

            return $this->createAuthenticationResult();
        }

        $authResult = $this->validateIdentity($identity);

        return $authResult;
    }

    /**
     * This method attempts to validate that the record in the resultset is indeed a
     * record that matched the identity provided to this adapter.
     *
     * @param  object $identity
     * @throws Exception\UnexpectedValueException
     * @return AuthenticationResult
     */
    protected function validateIdentity($identity)
    {
        $credentialProperty = $this->options->getCredentialProperty();
        $getter             = 'get' . ucfirst($credentialProperty);
        $documentCredential = null;

        if (method_exists($identity, $getter)) {
            $documentCredential = $identity->$getter();
        } elseif (property_exists($identity, $credentialProperty)) {
            $documentCredential = $identity->{$credentialProperty};
        } else {
            throw new Exception\UnexpectedValueException(
                sprintf(
                    'Property (%s) in (%s) is not accessible. You should implement %s::%s()',
                    $credentialProperty,
                    get_class($identity),
                    get_class($identity),
                    $getter
                )
            );
        }

        if (!$this->isInternalAuthentication()) {

            $credentialValue = $this->credential;
            $callable        = $this->options->getCredentialCallable();

            if ($callable) {
                $credentialValue = call_user_func($callable, $identity, $credentialValue);
            }

            if ($credentialValue !== true && $credentialValue !== $documentCredential) {
                $this->authenticationResultInfo['code']       = AuthenticationResult::FAILURE_CREDENTIAL_INVALID;
                $this->authenticationResultInfo['messages'][] = 'Supplied credential is invalid.';

                return $this->createAuthenticationResult();
            }
        }

        $this->authenticationResultInfo['code']       = AuthenticationResult::SUCCESS;
        $this->authenticationResultInfo['identity']   = $identity;
        $this->authenticationResultInfo['messages'][] = 'Authentication successful.';

        return $this->createAuthenticationResult();
    }

    /**
     * @return bool
     */
    public function isInternalAuthentication()
    {
        return $this->internalAuthentication;
    }

    /**
     * @param bool $internalAuthentication
     * @return ObjectRepository
     */
    public function setInternalAuthentication($internalAuthentication)
    {
        $this->internalAuthentication = $internalAuthentication;

        return $this;
    }
}